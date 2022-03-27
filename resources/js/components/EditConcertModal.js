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
    FormFeedback,
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
    const [price, setPrice] = useState(0);
    const [totalSeats, setTotalSeats] = useState(0);
    const [posterUrl, setPosterUrl] = useState("");
    const [titleError, setTitleError] = useState(false);
    const [performerError, setPerformerError] = useState(false);
    const [venueError, setVenueError] = useState(false);
    const [dateError, setDateError] = useState(false);
    const [timeError, setTimeError] = useState(false);
    const [priceError, setPriceError] = useState(false);
    const [totalSeatsError, setTotalSeatsError] = useState(false);
    const [posterUrlError, setPosterUrlError] = useState(false);

    const formChecker = async =>{
        if (title) {
            setTitleError(false);
        } else {
            setTitleError(true);
        }
        if (performer) {
            setPerformerError(false);
        } else {
            setPerformerError(true);
        }
        if (venue) {
            setVenueError(false);
        } else {
            setVenueError(true);
        }
        if (date) {
            setDateError(false);
        } else {
            setDateError(true);
        }
        if (time) {
            setTimeError(false);
        } else {
            setTimeError(true);
        }
        if (/(^$|^\d+(\.\d{1,2})?$)/.test(price) && price > 0) {
            setPriceError(false);
        } else {
            setPriceError(true);
        }
        if (/(^$|^\d+$)/.test(totalSeats) && totalSeats > 0) {
            setTotalSeatsError(false);
        } else {
            setTotalSeatsError(true);
        }
        if (posterUrl) {
            setPosterUrlError(false);
        } else {
            setPosterUrlError(true);
        }
    }

    const updateConcert = async (id) => {

        if (!timeError && !performerError && !venueError && !dateError && !timeError && !priceError
            && !totalSeatsError && !posterUrlError) {
            let res = await axios.put(`http://127.0.0.1:8000/api/concert/${editConcertId}`, {
                title: title,
                performer: performer,
                venue: venue,
                date: date,
                time: time,
                price: price,
                totalSeats: totalSeats,
                posterUrl: posterUrl,
            });
            if (res.status == 200) {
                alert("Update Successfully!");
                setShowModal(false);
                window.location.reload();
            }
        }
    };

    const getCurrentConcert = async () => {
        let res = await axios.get(
            `http://127.0.0.1:8000/api/concert/${editConcertId}`
        );
        setTitle(res.data.title);
        setDate(res.data.date);
        setPerformer(res.data.performer);
        setPrice(res.data.price);
        setTime(res.data.time);
        setVenue(res.data.venue);
        setTotalSeats(res.data.totalSeats);
        setPosterUrl(res.data.posterUrl);

    };

    function resetFormFeedback() {
        setTitleError(false);
        setPerformerError(false);
        setVenueError(false);
        setDateError(false);
        setTimeError(false);
        setPriceError(false);
        setTotalSeatsError(false);
        setPosterUrlError(false);
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
                        resetFormFeedback
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
                                invalid={titleError}
                            />
                            <FormFeedback>
                                Title cannot be blank
                            </FormFeedback>
                        </FormGroup>
                        <FormGroup>
                            <Label for="performer">Performer</Label>
                            <Input
                                id="performer"
                                name="performer"
                                placeholder="Enter Performer"
                                value={performer}
                                onChange={(e) => setPerformer(e.target.value)}
                                invalid={performerError}
                            />
                            <FormFeedback>
                                Performer cannot be blank
                            </FormFeedback>
                        </FormGroup>
                        <FormGroup>
                            <Label for="venue">Venue</Label>
                            <Input
                                id="venue"
                                name="venue"
                                placeholder="Enter Venue"
                                value={venue}
                                onChange={(e) => setVenue(e.target.value)}
                                invalid={venueError}
                            />
                            <FormFeedback>
                                Venue cannot be blank
                            </FormFeedback>
                        </FormGroup>
                        <FormGroup>
                            <Label for="date">Date</Label>
                            <Input
                                id="date"
                                name="date"
                                type="date"
                                value={date}
                                onChange={(e) => setDate(e.target.value)}
                                invalid={dateError}
                            />
                            <FormFeedback>
                                Date cannot be blank
                            </FormFeedback>
                        </FormGroup>
                        <FormGroup>
                            <Label for="time">Time</Label>
                            <Input
                                id="time"
                                name="time"
                                type="time"
                                value={time}
                                onChange={(e) => setTime(e.target.value)}
                                invalid={timeError}
                            />
                            <FormFeedback>
                                Time cannot be blank
                            </FormFeedback>
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
                                invalid={priceError}
                            />
                            <FormFeedback>
                                Only allow 2 decimal point and cannot be 0 or negative
                            </FormFeedback>
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
                                invalid={totalSeatsError}
                            />
                            <FormFeedback>
                                Only allow integer inputs and cannot be 0 or negative
                            </FormFeedback>
                        </FormGroup>
                        <FormGroup>
                            <Label for="posterUrl">Poster Image Url</Label>
                            <Input
                                id="posterUrl"
                                name="posterUrl"
                                placeholder="Enter Poster Url"
                                value={posterUrl}
                                onChange={(e) => setPosterUrl(e.target.value)}
                                invalid={posterUrlError}
                            />
                            <FormFeedback>
                                Poster Image Url cannot be blank
                            </FormFeedback>
                        </FormGroup>
                    </Form>
                </ModalBody>
                <ModalFooter>
                    <Button onClick={() =>{formChecker(); updateConcert();}} color="primary">Save</Button>{" "}
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
