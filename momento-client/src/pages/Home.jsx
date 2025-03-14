import React from 'react';
import Header from '../components/header';
import Footer from '../components/footer';
import FilterChips from '../components/FilterChips';
import CardsContainer from '../components/CardsContainer';

const Home = () => {
  const cardsData = [

    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
    { image: "src/assets/images/sidney-severin-R8Fg4uQfcGc-unsplash.jpg", title: "Ocean Waves", description: "Waves crashing on the shore." },
  ];
  return (
	<div>
    <Header/>
    <FilterChips/>
    <CardsContainer cards={cardsData}/>
	  <Footer/>
	</div>
  );
};

export default Home;