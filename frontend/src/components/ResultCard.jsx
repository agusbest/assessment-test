export default function ResultCard({ result }) {

    if (!result) return null;

    const formatDate = (date) => {

        if (!date) return "-";

        return new Date(date).toLocaleDateString("en-GB", {
            day: "2-digit",
            month: "short",
            year: "numeric",
        });

    };

    return (
        <div className="result-card">
            <div className="result-header">
                <div>
                    <p className="result-title">
                        Crew Member
                    </p>
                    <h2 className="result-name">
                        {result.crew?.name}
                    </h2>
                    <p className="result-text mt-4">
                        <strong>ID :</strong> {result.crew?.id}
                    </p>
                </div>

                <div>
                    <p className="result-title">
                        Flight Details
                    </p>
                    <h2 className="result-name">
                        {result.flight?.number}
                    </h2>
                    <p className="result-text mt-4">
                        {formatDate(result.flight?.date)}
                    </p>
                    <p className="result-text">
                        {result.flight?.aircraft}
                    </p>
                </div>
            </div>

            <div className="result-seat-section">
                <p className="result-title">
                    Generated Seats
                </p>
                <div className="result-seat-grid">
                    {result.seats?.map((seat) => (
                        <div
                            key={seat}
                            className="result-seat-card"
                        >
                            <div className="result-seat-number">
                                {seat}
                            </div>
                            <div className="result-seat-caption">
                                Voucher Seat
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}