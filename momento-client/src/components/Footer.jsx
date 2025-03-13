import React from 'react';
import "../css/components/footer.css"; 


const Footer = () => {
  return (
    <>
      <footer>
        <p>Momento – Capturing Life's Timeless Moments</p>
        <small>&copy; {new Date().getFullYear()} Momento. All rights reserved.</small>
      </footer>
    </>
  );
};

export default Footer;