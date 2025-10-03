import React, { useState } from 'react';

// Pre-Login Components
import LandingPage from './pages/LandingPage';
import TopNav from './components/TopNav';

// Post-Login Components
import Sidebar from './components/Sidebar';
import Header from './components/Header';
import BottomNav from './components/BottomNav';
import MealPlannerPage from './pages/MealPlannerPage';

// Main App Component with basic routing logic
function App() {
  // Simple state to simulate login status. Default to false (logged out).
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  // Layout for logged-out users
  const LoggedOutLayout = (
    <div className="bg-slate-100 min-h-screen">
      <TopNav />
      <LandingPage />
    </div>
  );

  // Layout for logged-in users
  const LoggedInLayout = (
    <div className="bg-slate-100 text-slate-900">
      <div className="flex h-screen">
        <Sidebar />
        <main className="flex-1 flex flex-col overflow-hidden pb-16 md:pb-0">
          <Header />
          <div className="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <MealPlannerPage />
          </div>
          <button className="absolute bottom-20 right-4 md:bottom-6 md:right-6 w-14 h-14 bg-primary-600 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-primary-700 transition-transform hover:scale-110">
            <i className="ph ph-plus text-3xl"></i>
          </button>
        </main>
      </div>
      <BottomNav />
    </div>
  );

  // Render the appropriate layout based on login status
  // For now, we default to the LoggedOutLayout.
  // To see the logged-in view, you can manually change the initial state of isLoggedIn to true.
  return isLoggedIn ? LoggedInLayout : LoggedOutLayout;
}

export default App;

