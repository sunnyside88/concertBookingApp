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

export default function ConcertModal() {
    const [showModal, setShowModal] = useState(false);
    return (
        <div>
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
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="performer">Performer</Label>
                            <Input
                                id="performer"
                                name="performer"
                                placeholder="Enter Performer"
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="venue">Venue</Label>
                            <Input
                                id="venue"
                                name="venue"
                                placeholder="Enter Venue"
                            />
                        </FormGroup>
                        <FormGroup>
                            <Label for="date">Date</Label>
                            <Input id="date" name="date" type="date" />
                        </FormGroup>
                        <FormGroup>
                            <Label for="time">Time</Label>
                            <Input id="time" name="time" type="time" />
                        </FormGroup>
                        <FormGroup>
                            <Label for="price">Price for each seat</Label>
                            <Input
                                id="price"
                                name="price"
                                placeholder="Enter Price"
                                type="number"
                            />
                        </FormGroup>
                    </Form>
                </ModalBody>
                <ModalFooter>
                    <Button color="primary" onClick={function noRefCheck() {}}>
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
