import React from "react";
import "../css/components/filterChips.css"; 

const FilterChips = () => {
    return (
        <div className="filter-container">
        <div className="chips-scroll-container">
            <div className="filter-chip active">All Photos</div>
            <div className="filter-chip">Nature</div>
            <div className="filter-chip">Travel</div>
            <div className="filter-chip">Vintage</div>
            <div className="filter-chip">Family</div>
            <div className="filter-chip">Black & White</div>
            <div className="filter-chip">Landscapes</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
            <div className="filter-chip">Portraits</div>
        </div>
    </div>
    );
}

export default FilterChips;