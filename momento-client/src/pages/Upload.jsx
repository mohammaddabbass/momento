import React, { useState } from 'react';
import "../css/pages/upload.css";
import Button from '../components/Button';

const Upload = () => {
  const [formData, setFormData] = useState({
    title: '',
    photo: null,
    description: '',
    tags: []
  });
  const [tagInput, setTagInput] = useState('');

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleFileUpload = (e) => {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      setFormData(prev => ({ ...prev, photo: file }));
    }
  };

  const handleTags = (e) => {
    if (e.key === 'Enter' || e.key === ',') {
      e.preventDefault();
      const newTag = tagInput.trim().replace(/,/g, '');
      if (newTag && !formData.tags.includes(newTag)) {
        setFormData(prev => ({
          ...prev,
          tags: [...prev.tags, newTag]
        }));
        setTagInput('');
      }
    }
  };

  const removeTag = (index) => {
    setFormData(prev => ({
      ...prev,
      tags: prev.tags.filter((_, i) => i !== index)
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    const data = new FormData();
    data.append('title', formData.title);
    data.append('photo', formData.photo);
    data.append('description', formData.description);
    formData.tags.forEach(tag => data.append('tags', tag));
    
    console.log('Form Data:', Object.fromEntries(data));
  };

  return (
    <div className='upload-page'>
      <form className="upload-form" onSubmit={handleSubmit}>
        <h2>Upload New Photo</h2>
        
        <div className="form-group">
          <label>Title</label>
          <input
            type="text"
            name="title"
            value={formData.title}
            onChange={handleInputChange}
            required
          />
        </div>

        <div className="form-group file-upload">
          <label>Photo</label>
          <div className="upload-area">
            <input
              type="file"
              accept="image/*"
              onChange={handleFileUpload}
              required
            />
            {formData.photo ? (
              <p>{formData.photo.name}</p>
            ) : (
              <p>Drag & drop or click to upload</p>
            )}
          </div>
        </div>

        <div className="form-group">
          <label>Description</label>
          <textarea
            name="description"
            value={formData.description}
            onChange={handleInputChange}
            rows="4"
            required
          />
        </div>

        <div className="form-group">
          <label>Tags</label>
          <div className="tags-input">
            {formData.tags.map((tag, index) => (
              <div className="tag" key={index}>
                {tag}
                <button type="button" onClick={() => removeTag(index)}>×</button>
              </div>
            ))}
            <input
              type="text"
              value={tagInput}
              onChange={(e) => setTagInput(e.target.value)}
              onKeyDown={handleTags}
              placeholder="Type tag and press comma or enter"
            />
          </div>
        </div>

        <Button text={"Upload Photo"}/>
      </form>
    </div>
  );
};

export default Upload;