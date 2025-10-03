import React from 'react';

const BottomNav = () => {
  return (
    <nav className="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 flex justify-around h-16 shadow-[0_-1px_3px_rgba(0,0,0,0.05)]">
      <a href="#" className="flex flex-col items-center justify-center text-primary-600 w-full">
        <i className="ph-fill ph-fork-knife text-2xl"></i>
        <span className="text-xs font-medium">Planer</span>
      </a>
      <a href="#" className="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
        <i className="ph ph-books text-2xl"></i>
        <span className="text-xs">Rezepte</span>
      </a>
      <a href="#" className="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
        <i className="ph ph-popcorn text-2xl"></i>
        <span className="text-xs">Serien</span>
      </a>
      <a href="#" className="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
        <i className="ph ph-bank text-2xl"></i>
        <span className="text-xs">Budget</span>
      </a>
      <a href="#" className="flex flex-col items-center justify-center text-slate-600 w-full opacity-50 pointer-events-none">
        <i className="ph ph-user-circle text-2xl"></i>
        <span className="text-xs">Profil</span>
      </a>
    </nav>
  );
};

export default BottomNav;