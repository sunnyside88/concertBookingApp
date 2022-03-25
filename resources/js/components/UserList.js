import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { Button, Table } from "reactstrap";
import axios from "axios";

export default function UserList() {
    const [data, setData] = useState([]);

    const getUserListing = async () => {
        let res = await axios.get("http://127.0.0.1:3000/api/userListing");
        setData(res.data);
    };

    const deleteUser = async (id) => {
        let res = await axios.delete(`http://127.0.0.1:3000/api/user/${id}`);
        window.location.reload();
    };

    useEffect(() => {
        getUserListing();
    }, []);

    return (
        <div>
            <Table striped>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {data.length > 0
                        ? data.map((x, index) => {
                              return (
                                  <tr key={index + 1}>
                                      <th scope="row">{index + 1}</th>
                                      <td>{x.name}</td>
                                      <td>{x.email}</td>
                                      <td>
                                          {"   "}
                                          <Button
                                              onClick={() => {
                                                  if (
                                                      window.confirm(
                                                          "Delete the user?"
                                                      )
                                                  ) {
                                                      deleteUser(x.id);
                                                  }
                                              }}
                                              color="danger"
                                          >
                                              Delete
                                          </Button>
                                      </td>
                                  </tr>
                              );
                          })
                        : null}
                </tbody>
            </Table>
        </div>
    );
}

if (document.getElementById("user-list")) {
    ReactDOM.render(<UserList />, document.getElementById("user-list"));
}
