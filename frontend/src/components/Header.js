import React from 'react';

const Header = () => {
  return (
    <header className="bg-white/80 backdrop-blur-sm border-b border-slate-200 z-10">
      <div className="px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          <div className="md:hidden">
            <h1 className="text-xl font-bold text-slate-900">Essensplaner</h1>
          </div>
          <div className="flex items-center justify-center flex-1">
            <button className="p-2 rounded-full hover:bg-slate-200">
              <i className="ph ph-caret-left text-xl"></i>
            </button>
            <h2 className="mx-4 text-lg font-semibold text-slate-800">Woche 40 (30. Sep - 06. Okt)</h2>
            <button className="p-2 rounded-full hover:bg-slate-200">
              <i className="ph ph-caret-right text-xl"></i>
            </button>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
