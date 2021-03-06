import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { Button, Table } from "reactstrap";
import axios from "axios";
import Breadcrumbs from "./Breadcrumbs";

export default function BookingList() {
    const [data, setData] = useState([]);

    const getBookingListing = async () => {
        let res = await axios.get("http://127.0.0.1:8000/api/bookingListing");
        console.log(res,"bookres")
        setData(res.data);
    };

    const deleteBooking = async (id) => {
        let res = await axios.delete(`http://127.0.0.1:8000/api/booking/${id}`);
        window.location.reload();
    };

    useEffect(() => {
        getBookingListing();
    }, []);

    return (
        <div>
            <Breadcrumbs activeLocation="Manage Bookings"></Breadcrumbs>
            <Table striped>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Purchased Date</th>
                        <th>Concert</th>
                        <th>Total Ticket Purchased</th>
                        <th>Total Amount</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {data.length > 0
                        ? data.map((x, index) => {
                            return (
                                <tr key={index + 1}>
                                    <th scope="row">{index + 1}</th>
                                    <td>{x.created_at}</td>
                                    <td>{x.title}</td>
                                    <td>{x.total_ticket}</td>
                                    <td>{x.total_amount}</td>
                                    <td>{x.email}</td>
                                    <td>
                                        {"   "}
                                        <Button
                                            onClick={() => {
                                                if (
                                                    window.confirm(
                                                        "Delete the booking?"
                                                    )
                                                ) {
                                                    deleteBooking(x.id);
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

if (document.getElementById("booking-list")) {
    ReactDOM.render(<BookingList />, document.getElementById("booking-list"));
}
