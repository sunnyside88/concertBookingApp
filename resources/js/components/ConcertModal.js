import React, { useState } from "react";
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
import Breadcrumbs from "./Breadcrumbs";

export default function ConcertModal() {
    const [showModal, setShowModal] = useState(false);
    const [title, setTitle] = useState("");
    const [performer, setPerformer] = useState("");
    const [venue, setVenue] = useState("");
    const [date, setDate] = useState("");
    const [time, setTime] = useState("");
    const [price, setPrice] = useState("");
    const [totalSeats, setTotalSeats] = useState("");
    const [posterUrl, setPosterUrl] = useState("")

    const addConcert = async () => {
        let res = await axios.post("http://127.0.0.1:3000/api/concert", {
            title: title,
            performer: performer,
            venue: venue,
            date: date,
            time: time,
            price: price,
            totalSeats: totalSeats,
            posterUrl:posterUrl,
        });
        if (res.status == 200) {
            alert("Added Successfully!");
            setShowModal(false);
            window.location.reload();
        }
    };

    return (
        <div>
            <Breadcrumbs activeLocation="Manage Concerts"></Breadcrumbs>
            <Button
                outline
                onClick={() => {
                    setShowModal(true);
                }}
            >
                New Concert
            </Button>
            <Modal isOpen={showModal}>
                <ModalHeader
                    toggle={() => {
                        setShowModal(false);
                    }}
                >
                    New Concert
                </ModalHeader>
                <ModalBody>
                    <Form>
                        <FormGroup>
                            <Label for="title">Title</Label>
                            <Input
                                id="title"
                                name="title"
                                placeholder="Enter title"
                                onChange={(e) => setTitle(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="performer">Performer</Label>
                            <Input
                                id="performer"
                                name="performer"
                                placeholder="Enter Performer"
                                onChange={(e) => setPerformer(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="venue">Venue</Label>
                            <Input
                                id="venue"
                                name="venue"
                                placeholder="Enter Venue"
                                onChange={(e) => setVenue(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="date">Date</Label>
                            <Input
                                id="date"
                                name="date"
                                type="date"
                                onChange={(e) => setDate(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="time">Time</Label>
                            <Input
                                id="time"
                                name="time"
                                type="time"
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
                                onChange={(e) => setTotalSeats(e.target.value)}
                            />
                        </FormGroup>
                        <FormGroup>
                        <Label for="posterUrl">Poster Image Url</Label>
                            <Input
                                id="posterUrl"
                                name="posterUrl"
                                placeholder="Enter Poster Url"
                                onChange={(e) => setPosterUrl(e.target.value)}
                            />
                        </FormGroup>
                    </Form>
                </ModalBody>
                <ModalFooter>
                    <Button color="primary" onClick={addConcert}>
                        Save
                    </Button>{" "}
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

if (document.getElementById("concert-modal")) {
    ReactDOM.render(<ConcertModal />, document.getElementById("concert-modal"));
}
