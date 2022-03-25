import React, { useState } from "react";
import ReactDOM from "react-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { Breadcrumb, BreadcrumbItem } from "reactstrap";

export default function Breadcrumbs({activeLocation}) {
    return (
        <Breadcrumb>
            <BreadcrumbItem>
                <a href="/admin">Dashboard</a>
            </BreadcrumbItem>
            <BreadcrumbItem active>{activeLocation}</BreadcrumbItem>
        </Breadcrumb>
    );
}

if (document.getElementById("breadcrumbs")) {
    ReactDOM.render(<Breadcrumbs />, document.getElementById("breadcrumbs"));
}
