import React from 'react';

const Sidebar = () => {
  return (
    <aside className="hidden md:flex flex-col w-64 bg-white border-r border-slate-200">
      <div className="flex items-center justify-center h-16 border-b border-slate-200">
        <i className="ph ph-calendar-check text-primary-600 text-3xl"></i>
        <h1 className="ml-2 text-xl font-bold text-slate-900">FamilienPlaner</h1>
      </div>
      <nav className="flex-1 px-4 py-4 space-y-2">
        <a href="#" className="flex items-center px-4 py-2 text-white bg-primary-600 rounded-lg shadow-sm">
          <i className="ph-fill ph-fork-knife text-lg"></i>
          <span className="ml-3 font-medium">Essensplaner</span>
        </a>
        <a href="#" className="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
          <i className="ph ph-books text-lg"></i>
          <span className="ml-3 font-medium">Rezeptkatalog</span>
        </a>
        <a href="#" className="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
          <i className="ph ph-popcorn text-lg"></i>
          <span className="ml-3 font-medium">Serien-Tracker</span>
        </a>
        <a href="#" className="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg opacity-50 pointer-events-none">
          <i className="ph ph-bank text-lg"></i>
          <span className="ml-3 font-medium">Haushaltsbuch</span>
        </a>
      </nav>
      <div className="px-4 py-4 border-t border-slate-200">
        <a href="#" className="flex items-center px-4 py-2 text-slate-700 hover:bg-slate-100 rounded-lg">
          <img src="https://placehold.co/40x40/6366f1/FFFFFF?text=M" alt="Benutzerbild" className="w-8 h-8 rounded-full" />
          <span className="ml-3 font-medium">Max Mustermann</span>
        </a>
      </div>
    </aside>
  );
};

export default Sidebar;
