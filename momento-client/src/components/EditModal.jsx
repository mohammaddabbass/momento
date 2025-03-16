import React from 'react';
import Input from './Input';

const EditModal = ({ isOpen, onClose }) => {
    if (!isOpen) return null; 

    return (
      <div className="edit-modal">
        <div className="modal-content">
          <h2>Edit Photo Details</h2>
          <form id="edit-form">
            <Input
              label="Title"
              type="text"
              value="Golden Hour Memories"
            />
            <Input
              label="Description"
              type="textarea"
              rows="4"
              value="A breath taking sunset captured during..."
            />
            <Input
              label="Tags (comma separated)"
              type="text"
              value="sunset, mountains, summer, nature"
            />
            <div className="actions-container">
              <button type="submit" className="btn btn-edit">
                Save Changes
              </button>
              <button type="button" className="btn btn-delete" onClick={onClose}>
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    );
};

export default EditModal;