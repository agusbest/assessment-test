import { useState } from "react";
import api from "../services/api";
import ResultCard from "./ResultCard";

const initialForm = {
    name: "",
    id: "",
    flightNumber: "",
    date: "",
    aircraft: "ATR",
};

export default function VoucherForm() {
    const [form, setForm] = useState(initialForm);
    const [loading, setLoading] = useState(false);
    const [result, setResult] = useState(null);
    const [alert, setAlert] = useState({
        show: false,
        type: "",
        message: "",
    });

    const showAlert = (type, message) => {
        setAlert({
            show: true,
            type,
            message,
        });

        setTimeout(() => {
            setAlert({
                show: false,
                type: "",
                message: "",
            });
        }, 3000);
    };

    const handleChange = (e) => {
        setForm((prev) => ({
            ...prev,
            [e.target.name]: e.target.value,
        }));
    };

    const handleReset = () => {
        setForm(initialForm);
        setResult(null);

        setAlert({
            show: false,
            type: "",
            message: "",
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        try {

            const check = await api.post("/check", {
                flightNumber: form.flightNumber,
                date: form.date,
            });
            if (check.data.exists) {
                showAlert(
                    "error",
                    "Voucher already exists for this flight."
                );
                setLoading(false);
                return;
            }
            const response = await api.post(
                "/generate",
                form
            );

            const data =
                response.data.data ??
                response.data;
            setResult(data);
            showAlert(
                "success",
                "Voucher generated successfully."
            );
            setForm(initialForm);
        } catch (err) {
            if (err.response?.status === 409) {
                showAlert(
                    "error",
                    "Voucher already exists."
                );
            } else if (err.response?.data?.message) {
                showAlert(
                    "error",
                    err.response.data.message
                );
            } else {
                showAlert(
                    "error",
                    "Cannot connect to server."
                );
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            {alert.show && (
                <div
                    className={
                        alert.type === "success"
                            ? "alert-success"
                            : "alert-error"
                    }
                >
                    {alert.message}
                </div>
            )}
            <form onSubmit={handleSubmit}>
                <div className="form-grid">
                    <div className="form-group">
                        <label className="form-label">
                            Crew Name
                        </label>
                        <input
                            className="form-control"
                            type="text"
                            name="name"
                            value={form.name}
                            onChange={handleChange}
                            placeholder="Enter crew name"
                            required
                        />
                    </div>
                    <div className="form-group">
                        <label className="form-label">
                            Crew ID
                        </label>
                        <input
                            className="form-control"
                            type="text"
                            name="id"
                            value={form.id}
                            onChange={handleChange}
                            placeholder="Enter crew ID"
                            required
                        />
                    </div>
                    <div className="form-group">
                        <label className="form-label">
                            Flight Number
                        </label>
                        <input
                            className="form-control"
                            type="text"
                            name="flightNumber"
                            value={form.flightNumber}
                            onChange={handleChange}
                            placeholder="GA101"
                            required
                        />
                    </div>
                    <div className="form-group">
                        <label className="form-label">
                            Flight Date
                        </label>
                        <input
                            className="form-control"
                            type="date"
                            name="date"
                            value={form.date}
                            onChange={handleChange}
                            required
                        />
                    </div>
                    <div className="form-group md:col-span-2">
                        <label className="form-label">
                            Aircraft Type
                        </label>
                        <select
                            className="form-control"
                            name="aircraft"
                            value={form.aircraft}
                            onChange={handleChange}
                        >
                            <option value="ATR">
                                ATR
                            </option>
                            <option value="Airbus 320">
                                Airbus 320
                            </option>
                            <option value="Boeing 737 Max">
                                Boeing 737 Max
                            </option>
                        </select>
                    </div>
                </div>
                <div className="button-group">
                    <button
                        type="submit"
                        disabled={loading}
                        className="btn-primary"
                    >
                        {loading
                            ? "Generating..."
                            : "Generate Voucher"}
                    </button>
                    <button
                        type="button"
                        onClick={handleReset}
                        className="btn-secondary"
                    >
                        Reset
                    </button>
                </div>
            </form>
            <ResultCard result={result} />
        </>
    );
}