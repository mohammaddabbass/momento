import React, { useEffect, useState } from 'react';
import Header from '../components/header';
import Footer from '../components/footer';
import FilterChips from '../components/FilterChips';
import CardsContainer from '../components/CardsContainer';
import { getPhotos } from '../utils/remote/axios';
import { requestMethods } from '../utils/enums/request.methods';

const Home = () => {
  const [photos , setPhotos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error,  setError] = useState(null);

  const user_id = localStorage.getItem("user_id");

  useEffect(() => { 
    const fetchPhotos = async () => {
      try {
        const response = await getPhotos({
          method: requestMethods.POST,
          route: "/photos",
          body: {
            "user_id": user_id
          }
        });

        if(response.error) {
          setError(response.message); 
        } else {
          setPhotos(Array.isArray(response.photos) ? response.photos : [response.photos]);
          console.log(response);
        }
      } catch (error) {
        setError(error.message);  
      } finally {
        setLoading(false);
      }
    };
    fetchPhotos();
  }, [user_id]);

  


  if (loading) {
    return <div>Loading photos...</div>;
  }

  if (error) {
    return <div>Error: {error}</div>;
  }

  const transformedPhotos = photos.map(photo => ({
    id: photo.id,
    image: photo.image_url || 'fallback-image.jpg',
    title: photo.title,
    description: photo.description,
    userId: photo.user_id,
    createdAt: photo.created_at
  }));

  return (
	<div>
    <Header/> 
    <FilterChips/>
    <CardsContainer cards={transformedPhotos}/>
	  <Footer/>
	</div>
  );
};

export default Home;