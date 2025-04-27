export const formatCurrency = (value) => {
    if (value === undefined || value === null || isNaN(value)) return "₱0";
    if (typeof value !== "number") return `₱${value}`;

    try {
        return `₱${value.toLocaleString()}`;
    } catch (error) {
        return `₱${value}`;
    }
};

// Format date helper
export const formatDate = (dateString) => {
    if (!dateString) return "N/A";

    try {
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    } catch (error) {
        return "Invalid date";
    }
};
