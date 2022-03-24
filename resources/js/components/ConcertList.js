import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { Button, Table } from "reactstrap";
import axios from "axios";
import EditConcertModal from "./EditConcertModal";

export default function ConcertList() {
    const [data, setData] = useState([]);
    const [showEditModal, setShowEditModal] = useState(false);

    const getConcertListing = async () => {
        let res = await axios.get("http://127.0.0.1:3000/api/concertListing");
        console.log(res);
        setData(res.data);
    };

    const deleteConcert = async (id) =>{
        let res = await axios.delete(`http://127.0.0.1:3000/api/concert/${id}`);
        window.location.reload()
    }

    useEffect(() => {
        getConcertListing();
    }, []);

    return (
        <div>
            <EditConcertModal showModal={showEditModal} setShowModal={setShowEditModal}></EditConcertModal>
            <Table striped>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Performer</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {data.length > 0
                        ? data.map((x, index) => {
                              return (
                                  <tr key={index + 1}>
                                      <th scope="row">{index + 1}</th>
                                      <td>{x.title}</td>
                                      <td>{x.performer}</td>
                                      <td>{x.venue}</td>
                                      <td>{x.date}</td>
                                      <td>{x.time}</td>
                                      <td>
                                          <Button
                                              onClick={() =>
                                                  setShowEditModal(true)
                                              }
                                              color="info"
                                          >
                                              Edit
                                          </Button>
                                          {"  "}
                                          <Button onClick={()=>{if(window.confirm('Delete the item?')){deleteConcert(x.id)};}} color="danger">Delete</Button>
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

if (document.getElementById("concert-list")) {
    ReactDOM.render(<ConcertList />, document.getElementById("concert-list"));
}
