import React from "react";
import { Container, Form, Button, Row, Col, Alert, Spinner } from "react-bootstrap";
import { useDispatch, useSelector } from "react-redux";
import {addClient} from "../../redux/ajouterClientSlice.js";
import { useFormik } from "formik";
import * as Yup from "yup";

export default function AjouterClient() {
    const dispatch = useDispatch();
    const { addClientLoading, addClientError } = useSelector((state) => state.addUser);

    const validationSchema = Yup.object({
        name: Yup.string().required("Ce champ est obligatoire."),
        code: Yup.string().required("Ce champ est obligatoire."),
    });

    const formik = useFormik({
        initialValues: {
            name: "",
            phone: "",
            code: "",
            email: "",
            type: "",
            address: "",
        },
        validationSchema,
        // onSubmit: (values) => {
        //     dispatch(addClient(values));
        // },

        onSubmit: async (values, { setSubmitting }) => {
            try {
                await dispatch(addClient(values)).unwrap();
                dispatch(setShowAddUser(false));
            } catch (error) {
                console.error("Erreur d'enregistrement:", error);
            } finally {
                setSubmitting(false);
            }
        },
    });


    return (
        <Container className="d-flex justify-content-center align-items-center vh-80">
            <Form onSubmit={formik.handleSubmit}>
                <h5 className="text-muted mb-4 border-bottom pb-2">Ajouter client</h5>

                <Row className="mb-3">
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Type</Form.Label>
                            <Form.Select
                                name="type"
                                className="form-control-lg"
                                value={formik.values.type}
                                onChange={formik.handleChange}
                            >
                                <option value="Particulier">Particulier</option>
                                <option value="Entreprise">Entreprise</option>
                                <option value="Association">Association</option>
                                <option value="Secteur Public">Secteur Public</option>
                            </Form.Select>
                        </Form.Group>
                    </Col>
                </Row>

                <Row className="mb-3">
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Référence</Form.Label>
                            <Form.Control
                                id="code"
                                type="text"
                                name="code"
                                className="form-control-lg"
                                value={formik.values.code}
                                onChange={formik.handleChange}
                            />
                            {formik.touched.code && formik.errors.code ? (
                                <div className="text-danger">{formik.errors.code}</div>
                            ) : null}
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Nom</Form.Label>
                            <Form.Control
                                id="name"
                                type="text"
                                name="name"
                                className="form-control-lg"
                                value={formik.values.name}
                                onChange={formik.handleChange}
                            />
                            {formik.touched.name && formik.errors.name ? (
                                <div className="text-danger">{formik.errors.name}</div>
                            ) : null}
                        </Form.Group>
                    </Col>
                </Row>

                <Row className="mb-3">
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Téléphone</Form.Label>
                            <Form.Control
                                id="phone"
                                type="tel"
                                name="phone"
                                className="form-control-lg"
                                value={formik.values.phone}
                                onChange={formik.handleChange}
                            />
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Address</Form.Label>
                            <Form.Control
                                id="address"
                                type="text"
                                name="address"
                                className="form-control-lg"
                                value={formik.values.address}
                                onChange={formik.handleChange}
                            />
                        </Form.Group>
                    </Col>
                    <Col md={6}>
                        <Form.Group>
                            <Form.Label>Email</Form.Label>
                            <Form.Control
                                id="email"
                                type="text"
                                name="email"
                                className="form-control-lg"
                                value={formik.values.email}
                                onChange={formik.handleChange}
                            />
                        </Form.Group>
                    </Col>
                </Row>

                {addClientError && <Alert variant="danger">{addClientError}</Alert>}

                <div className="d-grid gap-2 d-md-flex justify-content-md-end">
                    <Button variant="primary" type="submit" disabled={addClientLoading}>
                        {addClientLoading ? (
                            <>
                                <Spinner
                                    as="span"
                                    animation="border"
                                    size="sm"
                                    role="status"
                                    aria-hidden="true"
                                />
                                <span className="ms-2">Enregistrement...</span>
                            </>
                        ) : (
                            "Enregistrer"
                        )}
                    </Button>
                </div>
            </Form>
        </Container>
    );
}
