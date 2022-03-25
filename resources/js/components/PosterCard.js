import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import {
    Card,
    CardBody,
    CardGroup,
    CardText,
    CardSubtitle,
    CardTitle,
    CardImg,
    Button,
} from "reactstrap";
import axios from "axios";

export default function PosterCard() {
    const [data, setData] = useState([]);

    const getConcertListing = async () => {
        let res = await axios.get("http://127.0.0.1:3000/api/concertListing");
        setData(res.data);
    };

    useEffect(() => {
        getConcertListing();
    }, []);

    return (
        <CardGroup>
            {data.length > 0
                ? data.map((x, index) => {
                      return (
                          <Card style={{margin:10}}>
                              <CardImg
                                  alt="Card image cap"
                                  src={x.posterUrl}
                                  top
                                  width="5%"
                              />
                              <CardBody>
                                  <CardTitle tag="h5">{x.title}</CardTitle>
                                  <CardSubtitle
                                      className="mb-2 text-muted"
                                      tag="h6"
                                  >
                                      {x.performer}
                                  </CardSubtitle>
                                  <CardText>
                                      {x.date}, {x.time}
                                  </CardText>
                                  <Button>Book Now</Button>
                              </CardBody>
                          </Card>
                      );
                  })
                : null}
        </CardGroup>
    );
}

if (document.getElementById("poster-card")) {
    ReactDOM.render(<PosterCard />, document.getElementById("poster-card"));
}
