import VoucherForm from "../components/VoucherForm";

export default function Home() {
    return (
        <main className="page-container">

            <div className="content-wrapper">

                {/* Header */}

                <div className="page-header">

                    <h2 className="page-title">
                        Airline Voucher Seat Assignment
                    </h2>
                </div>

                {/* Form */}

                <div className="card">

                    <div className="card-body">

                        <div className="card-header">

                            <h2 className="card-title">
                                Crew Details
                            </h2>

                            <p className="card-subtitle">
                                Enter crew and flight information to generate
                                three random voucher seats.
                            </p>

                        </div>

                        <VoucherForm />

                    </div>

                </div>

            </div>

        </main>
    );
}