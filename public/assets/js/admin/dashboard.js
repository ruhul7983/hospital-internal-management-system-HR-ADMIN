(function () {
  const sidebar = document.querySelector('#sidebar');
  const backdrop = document.querySelector('#sidebarBackdrop');
  const toggleBtn = document.querySelector('#sidebarToggle');

  const isDesktop = () => window.matchMedia('(min-width: 1024px)').matches;

  function openSidebar() {
    if (sidebar) sidebar.classList.remove('-translate-x-full');
    if (toggleBtn) toggleBtn.setAttribute('aria-pressed', 'true');
    if (!isDesktop()) {
      if (backdrop) backdrop.classList.remove('hidden');
      document.documentElement.style.overflow = 'hidden';
    }
  }

  function closeSidebar() {
    if (sidebar) sidebar.classList.add('-translate-x-full');
    if (toggleBtn) toggleBtn.setAttribute('aria-pressed', 'false');
    if (backdrop) backdrop.classList.add('hidden');
    document.documentElement.style.overflow = '';
  }

  function initLayout() {
    if (isDesktop()) {
      sidebar?.classList.remove('-translate-x-full');
      backdrop?.classList.add('hidden');
      document.documentElement.style.overflow = '';
    } else {
      sidebar?.classList.add('-translate-x-full');
    }
  }

  // Events
  if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
      const isHidden = sidebar.classList.contains('-translate-x-full');
      isHidden ? openSidebar() : closeSidebar();
    });
  }

  if (backdrop) backdrop.addEventListener('click', closeSidebar);
  document.addEventListener('keydown', (e) => e.key === 'Escape' && closeSidebar());
  window.addEventListener('resize', initLayout);
  initLayout();

  // Close on link click (mobile)
  document.querySelectorAll('#sidebarNav a[href]').forEach((a) => {
    a.addEventListener('click', () => {
      if (!isDesktop()) closeSidebar();
    });
  });

  // Accordion
  document.querySelectorAll('.nav-group').forEach((group) => {
    const trigger = group.querySelector('.nav-trigger');
    const panel = group.querySelector('.nav-panel');
    const chevron = trigger?.querySelector('.chevron');
    if (!trigger || !panel) return;

    trigger.addEventListener('click', () => {
      const isOpen = !panel.classList.contains('hidden');
      panel.classList.toggle('hidden');
      trigger.setAttribute('aria-expanded', String(!isOpen));
      chevron && chevron.classList.toggle('rotate-180');
    });
  });

  // Profile dropdown
  const userBtn = document.querySelector('#userMenuButton');
  const userMenu = document.querySelector('#userMenu');

  if (userBtn && userMenu) {
    userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = !userMenu.classList.contains('hidden');
      userMenu.classList.toggle('hidden');
      userBtn.setAttribute('aria-expanded', String(!open));
    });

    document.addEventListener('click', (e) => {
      if (!userMenu.classList.contains('hidden') &&
          !userMenu.contains(e.target) &&
          !userBtn.contains(e.target)) {
        userMenu.classList.add('hidden');
        userBtn.setAttribute('aria-expanded', 'false');
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !userMenu.classList.contains('hidden')) {
        userMenu.classList.add('hidden');
        userBtn.setAttribute('aria-expanded', 'false');
      }
    });
  }
})();
