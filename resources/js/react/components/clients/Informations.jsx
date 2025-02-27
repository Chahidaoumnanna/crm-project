// import React from "react";
// import dayjs from "dayjs";
// import { Container, Form, Row, Col, InputGroup, Button, Modal } from "react-bootstrap";
// import { FaUserTag } from "react-icons/fa6";
// import "bootstrap/dist/css/bootstrap.min.css";
// import { useSelector, useDispatch } from "react-redux";
// import { setNlivraison, setDate, setObservation, setShowAddUser } from '../../redux/informationSlice.js'
// import RecherchClient from "./RecherchClient.jsx";
// import AjouterClient from "./AjouterClient.jsx";
// import { useFormik } from "formik";
// import * as Yup from "yup";
//
// export default function Informations() {
//     const dispatch = useDispatch();
//
//     const {nlivraison, date, observation, showAddUser} = useSelector(
//         (state) => state.formInfo
//     );
//     // const lastAddedClient = useSelector((state) => state.addUser.lastAddedClient);
//
//     const formattedDate = date ? dayjs(date).format("YYYY-MM-DDTHH:mm") : "";
//
//     const validationSchema = Yup.object({
//         name: Yup.string().required("Le nom est requis"),
//         nlivraison: Yup.string().required("Le numéro de bon de livraison est requis"),
//         date: Yup.date().required("La date de vente est requise"),
//         observation: Yup.string().max(500, "L'observation ne doit pas dépasser 500 caractères"),
//     });
//
//     const formik = useFormik({
//         initialValues: {
//             name: "",
//             nlivraison: nlivraison || "",
//             date: formattedDate || "",
//             observation: observation || "",
//         },
//         validationSchema,
//         onSubmit: (values) => {
//             dispatch(setNlivraison(values.nlivraison));
//             dispatch(setDate(values.date));
//             dispatch(setObservation(values.observation));
//         },
//     });
//
//     const handleAddUserClick = () => {
//         dispatch(setShowAddUser(true));
//     };
//
//     return (
//         <Container fluid className="p-4">
//             <Form onSubmit={formik.handleSubmit} className="shadow-sm p-4 rounded bg-white">
//                 <h5 className="text-muted mb-4 border-bottom pb-2">Informations :</h5>
//                 <Row className="align-items-center">
//                     <Col md={3}>
//                         <Form.Group controlId="name">
//                             <Form.Label>Client</Form.Label>
//                             <InputGroup className="d-flex">
//                                 <div className="flex-grow-1">
//
//                                     <RecherchClient
//                                         onChange={(value) => formik.setFieldValue("name", value)}
//                                     />
//                                 </div>
//                             </InputGroup>
//                             {formik.touched.name && formik.errors.name ? (
//                                 <div className="text-danger">{formik.errors.name}</div>
//                             ) : null}
//                         </Form.Group>
//                     </Col>
//                     <Col md={1}>
//                         <Form.Group controlId="addClient">
//                             <Form.Label className="invisible">Ajouter Client</Form.Label>
//                             <Button variant="outline-primary" className="w-100" onClick={handleAddUserClick}>
//                                 <FaUserTag/> Client
//                             </Button>
//                         </Form.Group>
//                     </Col>
//                     <Col md={4}>
//                         <Form.Group controlId="nlivraison">
//                             <Form.Label>N° de bon livraison</Form.Label>
//                             <Form.Control
//                                 type="text"
//                                 name="nlivraison"
//                                 value={formik.values.nlivraison}
//                                 onChange={formik.handleChange}
//                                 onBlur={formik.handleBlur}
//                             />
//                             {formik.touched.nlivraison && formik.errors.nlivraison ? (
//                                 <div className="text-danger">{formik.errors.nlivraison}</div>
//                             ) : null}
//                         </Form.Group>
//                     </Col>
//                     <Col md={4}>
//                         <Form.Group controlId="date">
//                             <Form.Label>Date vente</Form.Label>
//                             <Form.Control
//                                 type="datetime-local"
//                                 name="date"
//                                 value={formik.values.date}
//                                 onChange={formik.handleChange}
//                                 onBlur={formik.handleBlur}
//                             />
//                             {formik.touched.date && formik.errors.date ? (
//                                 <div className="text-danger">{formik.errors.date}</div>
//                             ) : null}
//                         </Form.Group>
//                     </Col>
//                 </Row>
//                 <Row className="mb-3">
//                     <Col>
//                         <Form.Group controlId="observation">
//                             <Form.Label className="mt-3">Observation</Form.Label>
//                             <Form.Control
//                                 as="textarea"
//                                 rows={3}
//                                 name="observation"
//                                 value={formik.values.observation}
//                                 onChange={formik.handleChange}
//                                 onBlur={formik.handleBlur}
//                             />
//                             {formik.touched.observation && formik.errors.observation ? (
//                                 <div className="text-danger">{formik.errors.observation}</div>
//                             ) : null}
//                         </Form.Group>
//                     </Col>
//                 </Row>
//             </Form>
//
//             <Modal
//                 show={showAddUser}
//                 onHide={() => dispatch(setShowAddUser(false))}
//                 centered
//                 size="lg"
//                 aria-labelledby="addUserModal"
//             >
//                 <Modal.Header closeButton></Modal.Header>
//                 <Modal.Body>
//                     <AjouterClient/>
//                 </Modal.Body>
//             </Modal>
//         </Container>
//     );
// }


import React from "react";
import dayjs from "dayjs";
import { Container, Form, Row, Col, InputGroup, Button, Modal, Card } from "react-bootstrap";
import { FaUserTag } from "react-icons/fa6";
import "bootstrap/dist/css/bootstrap.min.css";
import { useSelector, useDispatch } from "react-redux";
import { setNlivraison, setDate, setObservation, setShowAddUser } from '../../redux/informationSlice.js';
import RecherchClient from "./RecherchClient.jsx";
import AjouterClient from "./AjouterClient.jsx";
import { useFormik } from "formik";
import * as Yup from "yup";

export default function Informations() {
    const dispatch = useDispatch();
    const { nlivraison, date, observation, showAddUser } = useSelector((state) => state.formInfo);

    const formattedDate = date ? dayjs(date).format("YYYY-MM-DDTHH:mm") : "";

    const validationSchema = Yup.object({
        name: Yup.string().required("Le nom est requis"),
        nlivraison: Yup.string().required("Le numéro de bon de livraison est requis"),
        date: Yup.date().required("La date de vente est requise"),
        observation: Yup.string().max(500, "L'observation ne doit pas dépasser 500 caractères"),
    });

    const formik = useFormik({
        initialValues: {
            name: "",
            nlivraison: nlivraison || "",
            date: formattedDate || "",
            observation: observation || "",
        },
        validationSchema,
        onSubmit: (values) => {
            dispatch(setNlivraison(values.nlivraison));
            dispatch(setDate(values.date));
            dispatch(setObservation(values.observation));
        },
    });

    const handleAddUserClick = () => {
        dispatch(setShowAddUser(true));
    };

    return (
        <Container fluid className="p-3 d-flex justify-content-center">
            <Card className="shadow-sm border-0 w-100">
                <Card.Body className="p-4">
                    <h5 className="text-dark mb-4 border-bottom pb-2">Informations</h5>
                    <Form onSubmit={formik.handleSubmit}>
                        <Row className="g-3">
                            {/* Client */}
                            <Col md={6}>
                                <Form.Group controlId="name">
                                    <Form.Label className="fw-semibold">Client</Form.Label>
                                    <InputGroup>
                                        <RecherchClient
                                            onChange={(value) => formik.setFieldValue("name", value)}
                                        />
                                    </InputGroup>
                                    {formik.touched.name && formik.errors.name && (
                                        <div className="text-danger">{formik.errors.name}</div>
                                    )}
                                </Form.Group>
                            </Col>

                            {/* Ajouter Client */}
                            <Col md={2} className="d-flex align-items-end">
                                <Button variant="primary w-100" onClick={handleAddUserClick}>
                                    <FaUserTag className="me-2"/> Ajouter
                                </Button>
                            </Col>

                            {/* N° de bon livraison */}
                            <Col md={4}>
                                <Form.Group controlId="nlivraison">
                                    <Form.Label className="fw-semibold">N° de bon livraison</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="nlivraison"
                                        value={formik.values.nlivraison}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                    />
                                    {formik.touched.nlivraison && formik.errors.nlivraison && (
                                        <div className="text-danger">{formik.errors.nlivraison}</div>
                                    )}
                                </Form.Group>
                            </Col>

                            {/* Date vente */}
                            <Col md={6}>
                                <Form.Group controlId="date">
                                    <Form.Label className="fw-semibold">Date de vente</Form.Label>
                                    <Form.Control
                                        type="datetime-local"
                                        name="date"
                                        value={formik.values.date}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                    />
                                    {formik.touched.date && formik.errors.date && (
                                        <div className="text-danger">{formik.errors.date}</div>
                                    )}
                                </Form.Group>
                            </Col>

                            {/* Observation */}
                            <Col md={6}>
                                <Form.Group controlId="observation">
                                    <Form.Label className="fw-semibold">Observation</Form.Label>
                                    <Form.Control
                                        as="textarea"
                                        rows={3}
                                        name="observation"
                                        value={formik.values.observation}
                                        onChange={formik.handleChange}
                                        onBlur={formik.handleBlur}
                                    />
                                    {formik.touched.observation && formik.errors.observation && (
                                        <div className="text-danger">{formik.errors.observation}</div>
                                    )}
                                </Form.Group>
                            </Col>

                            {/* Bouton de soumission */}
                            <Col md={12} className="text-end">
                                <Button type="submit" variant="success">
                                    Enregistrer
                                </Button>
                            </Col>
                        </Row>
                    </Form>
                </Card.Body>
            </Card>

            {/* Modal d'ajout de client */}
            <Modal
                show={showAddUser}
                onHide={() => dispatch(setShowAddUser(false))}
                centered
                size="lg"
                aria-labelledby="addUserModal"
            >
                <Modal.Header closeButton></Modal.Header>
                <Modal.Body>
                    <AjouterClient/>
                </Modal.Body>
            </Modal>
        </Container>
    );
}
