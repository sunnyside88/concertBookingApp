import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { Button, Table } from "reactstrap";
import axios from "axios";
import Breadcrumbs from "./Breadcrumbs";
import $ from 'jquery'

export default function UserBookingList() {
    const [data, setData] = useState([]);

    const getBookingListing = async () => {
        let userId= $('#user-booking-list').attr("user-id")
        let res = await axios.get(`http://127.0.0.1:8000/api/bookingListing/${userId}`);
        console.log(res,"xxx")
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
            {/* <Breadcrumbs activeLocation="Manage Bookings"></Breadcrumbs> */}
            <Table striped>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Purchased Date</th>
                        <th>Concert</th>
                        <th>Performer</th>
                        <th>Date/Time</th>
                        <th>Total Ticket Purchased</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {data.length > 0
                        ? data.map((x, index) => {
                            return (
                                <tr key={index + 1}>
                                    <th scope="row">{index + 1}</th>
                                    <td>{x.created_at.substring(0, 10)}</td>
                                    <td>{x.title}</td>
                                    <td>{x.performer}</td>
                                    <td>{x.date}/{x.time}</td>
                                    <td>{x.total_ticket}</td>
                                    <td>{x.total_amount}</td>
                                </tr>
                            );
                        })
                        : null}
                </tbody>
            </Table>
        </div>
    );
}

if (document.getElementById("user-booking-list")) {
    ReactDOM.render(<UserBookingList />, document.getElementById("user-booking-list"));
}
