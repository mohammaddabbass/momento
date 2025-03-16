import "../css/pages/photoDetails.css"; 

import FilterChips from '../components/FilterChips';
import EditModal from '../components/EditModal';
import Button from '../components/Button';
import React, { useState } from "react";

const PhotoDetails = () => {
    
    const [isModalOpen, setIsModalOpen] = useState(false);


  return (
    <div className="photo-details">
    <div className="photo-container">
    <div className="image-section">
        <img src="src\assets\images\markus-spiske-w0ORUlAunk0-unsplash.jpg" alt="Selected Photo" className="photo-image"></img>
    </div>
    
    <div className="details-section">
        <h1 className="photo-title">Golden Hour Memories</h1>
        
        <div className="meta-data">
            <span>Uploaded: March 15, 2023</span>
        </div>
        
        <p className="photo-description">
            A breathtaking sunset captured during our summer trip to the mountains. 
            The golden hues perfectly capture the tranquility of the moment.
        </p>
        
        <div className="tags-container">
            <span className="tag">sunset</span>
            <span className="tag">mountains</span>
            <span className="tag">summer</span>
            <span className="tag">nature</span>
        </div>
        
        <div className="actions-container">
            <Button text={"Edit"} onClick={() => {setIsModalOpen(true);}}/>
            <Button text={"Delete"} variant='secondary' />
            
        </div>
    </div>
   </div>

   <EditModal isOpen={isModalOpen} onClose={( () => setIsModalOpen(false))}/>
   </div>
  );
};

export default PhotoDetails;