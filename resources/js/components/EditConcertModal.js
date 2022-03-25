import React, { useEffect, useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import {
    Button,
    Modal,
    ModalBody,
    ModalHeader,
    ModalFooter,
    Form,
    FormGroup,
    Input,
    Label,
} from "reactstrap";
import axios from "axios";

export default function EditConcertModal({
    showModal,
    setShowModal,
    editConcertId,
}) {
    const [title, setTitle] = useState("");
    const [performer, setPerformer] = useState("");
    const [venue, setVenue] = useState("");
    const [date, setDate] = useState("");
    const [time, setTime] = useState("");
    const [price, setPrice] = useState("");
    const [totalSeats, setTotalSeats] = useState("");

    const updateConcert = async (id) => {
        let res = await axios.put(`http://127.0.0.1:3000/api/concert/${editConcertId}`, {
            title: title,
            performer: performer,
            venue: venue,
            date: date,
            time: time,
            price: price,
            totalSeats: totalSeats,
        });
        if (res.status == 200) {
            alert("Update Successfully!");
            setShowModal(false);
            window.location.reload();
        }
    };

    const getCurrentConcert = async () => {
        let res = await axios.get(
            `http://127.0.0.1:3000/api/concert/${editConcertId}`
        );
        setTitle(res.data.title);
        setDate(res.data.date);
        setPerformer(res.data.performer);
        setPrice(res.data.price);
        setTime(res.data.time);
        setVenue(res.data.venue);
        setTotalSeats(res.data.totalSeats);
    };

    useEffect(() => {
        if (editConcertId) {
            getCurrentConcert();
        }
    }, [editConcertId]);

    return (
        <div>
            <Modal isOpen={showModal}>
                <ModalHeader
                    toggle={() => {
                        setShowModal(false);
                    }}
                >
                    Edit Concert
                </ModalHeader>
                <ModalBody>
                    <Form>
                        <FormGroup>
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                name="title"
                                placeholder="Enter title"
                                value={title}
                                onChange={(e) => setTitle(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="performer">Performer</Label>
                            <Input
                                id="performer"
                                name="performer"
                                placeholder="Enter Performer"
                                value={performer}
                                onChange={(e) => setPerformer(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="venue">Venue</Label>
                            <Input
                                id="venue"
                                name="venue"
                                placeholder="Enter Venue"
                                value={venue}
                                onChange={(e) => setVenue(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="date">Date</Label>
                            <Input
                                id="date"
                                name="date"
                                type="date"
                                value={date}
                                onChange={(e) => setDate(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="time">Time</Label>
                            <Input
                                id="time"
                                name="time"
                                type="time"
                                value={time}
                                onChange={(e) => setTime(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="price">Price for each seat</Label>
                            <Input
                                id="price"
                                name="price"
                                placeholder="Enter Price"
                                type="number"
                                value={price}
                                onChange={(e) => setPrice(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="totalSeats">Total Seat Available</Label>
                            <Input
                                id="totalSeats"
                                name="totalSeats"
                                placeholder="Enter total seats"
                                type="number"
                                value={totalSeats}
                                onChange={(e) => setTotalSeats(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="poster">File</Label>
                            <Input
                                id="poster"
                                name="file"
                                type="file"
                                accept="image/png, image/jpeg"
                            />
                        </FormGroup>
                    </Form>
                </ModalBody>
                <ModalFooter>
                    <Button onClick={()=>updateConcert()} color="primary">Save</Button>{" "}
                    <Button
                        onClick={() => {
                            setShowModal(false);
                        }}
                    >
                        Cancel
                    </Button>
                </ModalFooter>
            </Modal>
        </div>
    );
}

if (document.getElementById("edit-concert-modal")) {
    ReactDOM.render(
        <EditConcertModal />,
        document.getElementById("edit-concert-modal")
    );
}
