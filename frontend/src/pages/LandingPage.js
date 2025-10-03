import React from 'react';

const LandingPage = () => {
  return (
    <div className="flex flex-col items-center justify-center min-h-screen text-center px-4">
      <h1 className="text-4xl md:text-6xl font-bold text-slate-900 mb-4">Der einfachste Weg, euren Familienalltag zu organisieren.</h1>
      <p className="text-lg md:text-xl text-slate-700 max-w-3xl mb-8">
        Behaltet Termine, Aufgaben und Einkaufslisten im Blick. Der FamilienPlaner hilft euch, den Überblick zu behalten und mehr Zeit für die schönen Dinge im Leben zu haben.
      </p>
      <div>
        <button className="px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700 text-lg">Jetzt loslegen</button>
      </div>
    </div>
  );
};

export default LandingPage;
