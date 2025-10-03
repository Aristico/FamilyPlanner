import React from 'react';

const TopNav = () => {
  return (
    <nav className="absolute top-0 left-0 right-0 bg-transparent p-4 z-10">
      <div className="container mx-auto flex justify-between items-center">
        <div className="flex items-center">
          <i className="ph ph-calendar-check text-primary-600 text-3xl"></i>
          <h1 className="ml-2 text-xl font-bold text-slate-900">FamilienPlaner</h1>
        </div>
        <div className="flex gap-4">
          <button className="px-4 py-2 text-slate-700 font-semibold rounded-lg hover:bg-slate-100">Login</button>
          <button className="px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg shadow-sm hover:bg-primary-700">Registrieren</button>
        </div>
      </div>
    </nav>
  );
};

export default TopNav;
