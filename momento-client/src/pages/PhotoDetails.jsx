import React from 'react';
import "../css/pages/photoDetails.css"; 

import FilterChips from '../components/FilterChips';
import Button from '../components/Button';

const PhotoDetails = () => {
  return (
    <div className="photo-details">
    <div class="photo-container">
    <div class="image-section">
        <img src="src\assets\images\sidney-severin-R8Fg4uQfcGc-unsplash.jpg" alt="Selected Photo" class="photo-image"></img>
    </div>
    
    <div class="details-section">
        <h1 class="photo-title">Golden Hour Memories</h1>
        
        <div class="meta-data">
            <span>Uploaded: March 15, 2023</span>
        </div>
        
        <p class="photo-description">
            A breathtaking sunset captured during our summer trip to the mountains. 
            The golden hues perfectly capture the tranquility of the moment.
        </p>
        
        <div class="tags-container">
            <span class="tag">sunset</span>
            <span class="tag">mountains</span>
            <span class="tag">summer</span>
            <span class="tag">nature</span>
        </div>
        
        <div class="actions-container">
            <Button text={"Edit"}/>
            <Button text={"Delete"} variant='secondary' />
            
        </div>
    </div>
   </div>
   </div>
  );
};

export default PhotoDetails;