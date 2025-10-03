import React from 'react';

const HomePage = () => {
  const days = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'];

  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-4">
      {days.map(day => (
        <div key={day} className="space-y-4">
          <h3 className="font-bold text-center text-slate-700">{day}</h3>
          {day === 'Montag' ? (
            <>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
                <div className="text-xs font-semibold text-slate-500">Frühstück</div>
                <div className="bg-sky-200 text-sky-900 p-2 rounded-md">
                  <p className="font-semibold text-sm">Müsli & Joghurt</p>
                  <span className="text-xs flex items-center mt-1 font-medium"><i className="ph-fill ph-users mr-1"></i> 2 Pers.</span>
                </div>
              </div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
                <div className="text-xs font-semibold text-slate-500">Mittagessen</div>
                <div className="bg-amber-200 text-amber-900 p-2 rounded-md">
                  <p className="font-semibold text-sm">Außer Haus</p>
                  <span className="text-xs flex items-center mt-1 font-medium"><i className="ph-fill ph-storefront mr-1"></i> 1 Pers.</span>
                </div>
              </div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
                <div className="text-xs font-semibold text-slate-500">Abendessen</div>
                <div className="bg-emerald-200 text-emerald-900 p-2 rounded-md">
                  <p className="font-semibold text-sm">Spaghetti Bolognese</p>
                  <span className="text-xs flex items-center mt-1 font-medium"><i className="ph-fill ph-users mr-1"></i> 4 Pers.</span>
                </div>
              </div>
            </>
          ) : day === 'Dienstag' ? (
            <>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm space-y-2">
                <div className="text-xs font-semibold text-slate-500">Abendessen</div>
                <div className="bg-emerald-200 text-emerald-900 p-2 rounded-md">
                  <p className="font-semibold text-sm">Hähnchen Curry</p>
                  <span className="text-xs flex items-center mt-1 font-medium"><i className="ph-fill ph-users mr-1"></i> 4 Pers.</span>
                </div>
              </div>
            </>
          ) : (
            <>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
              <div className="min-h-[100px] bg-white p-2.5 rounded-lg border border-slate-200 shadow-sm"></div>
            </>
          )}
        </div>
      ))}
    </div>
  );
};

export default HomePage;
