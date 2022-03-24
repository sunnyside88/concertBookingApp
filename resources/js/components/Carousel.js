import React, { useState } from "react";
import ReactDOM from "react-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import { UncontrolledCarousel } from 'reactstrap';

export default function Carousel() {
    return (
        <UncontrolledCarousel
            items={[
                {
                    altText: "Slide 1",
                    key: 1,
                    src: "https://media.thevibes.com/images/uploads/covers/2022/February_2022/_large/191985192_340690064079968_5750107449348201486_n.jpeg",
                },
                {
                    altText: "Slide 2",
                    key: 2,
                    src: "https://storage.googleapis.com/c.directlyrics.com/img/upload/justin-bieber-purpose-tour.jpg",

                },
                {
                    altText: "Slide 3",
                    key: 3,
                    src: "https://media.thevibes.com/images/uploads/covers/2022/February_2022/_large/191985192_340690064079968_5750107449348201486_n.jpeg",

                },
            ]}
        />
    );
}

if (document.getElementById("carousel")) {
    ReactDOM.render(<Carousel />, document.getElementById("carousel"));
}
