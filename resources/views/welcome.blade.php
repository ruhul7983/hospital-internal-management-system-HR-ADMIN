<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospital Internal Management System</title>
    @vite('resources/css/app.css');
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="antialiased text-slate-700">
    <!-- Top Announcement -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-sm">
        <div class="max-w-7xl mx-auto px-4 py-2 text-center">
            🎉 Launch promo: 2 months free on annual plans. <a href="#pricing" class="underline font-semibold">See
                pricing</a>
        </div>
    </div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="#" class="flex items-center gap-2">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white font-bold">HI</span>
                    <span class="font-semibold text-slate-900">Hospital IMS</span>
                </a>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#features" class="hover:text-slate-900">Features</a>
                    <a href="#about" class="hover:text-slate-900">About</a>
                    <a href="#pricing" class="hover:text-slate-900">Pricing</a>
                    <a href="#faq" class="hover:text-slate-900">FAQ</a>
                </nav>
                <div class="flex items-center gap-2">
                    <a href="/login" class="px-4 py-2 text-sm font-medium rounded-xl hover:bg-slate-100">Login</a>
                    
                </div>
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-emerald-50 to-white"></div>
        <div class="max-w-7xl mx-auto px-4 py-20 lg:py-28">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div>
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-white px-3 py-1 text-xs text-emerald-700">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        HIPAA-ready workflows
                    </div>
                    <h1 class="mt-4 text-4xl/tight md:text-5xl/tight font-extrabold text-slate-900">
                        Run your hospital on one secure, modern platform
                    </h1>
                    <p class="mt-4 text-lg text-slate-600 max-w-xl">
                        Hospital IMS unifies patient records, scheduling, billing, inventory, HR, and analytics so your
                        teams move faster, stay compliant, and deliver better care.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center gap-3">
                        <a href="#pricing"
                            class="px-6 py-3 rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 font-semibold">Book
                            a Demo</a>
                        <a href="#features"
                            class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 font-semibold">Explore
                            Features</a>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">No credit card required • 99.9% uptime SLA • Role-based
                        access</p>
                </div>
                <div class="relative">
                    <div
                        class="absolute -inset-6 -z-10 bg-gradient-to-tr from-emerald-200/40 to-transparent blur-2xl rounded-3xl">
                    </div>
                    <div class="border border-slate-200 rounded-2xl shadow-xl bg-white">
                        <!-- Dashboard mock -->
                        <div class="p-4 border-b border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="h-3 w-3 rounded-full bg-slate-300"></span>
                                <span class="h-3 w-3 rounded-full bg-slate-300"></span>
                                <span class="h-3 w-3 rounded-full bg-slate-300"></span>
                            </div>
                            <span class="text-sm font-medium text-slate-600">Dashboard Preview</span>
                            <div></div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 p-6">
                            <div class="space-y-4">
                                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100">
                                    <p class="text-sm text-emerald-700">Today's Appointments</p>
                                    <p class="mt-1 text-3xl font-bold text-emerald-900">128</p>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <p class="text-sm text-slate-600">Inpatients</p>
                                    <p class="mt-1 text-3xl font-bold text-slate-900">342</p>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <p class="text-sm text-slate-600">Avg. Wait Time</p>
                                    <p class="mt-1 text-3xl font-bold text-slate-900">11m</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <p class="text-sm text-slate-600">Revenue (30d)</p>
                                    <p class="mt-1 text-3xl font-bold text-slate-900">$2.1M</p>
                                </div>
                                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <p class="text-sm text-slate-600">Inventory Alerts</p>
                                    <p class="mt-1 text-3xl font-bold text-slate-900">6</p>
                                </div>
                                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100">
                                    <p class="text-sm text-emerald-700">Claims Acceptance</p>
                                    <p class="mt-1 text-3xl font-bold text-emerald-900">98.7%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust bar -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-5 gap-6 items-center opacity-70">
                <div class="h-8 bg-slate-100 rounded"></div>
                <div class="h-8 bg-slate-100 rounded"></div>
                <div class="h-8 bg-slate-100 rounded"></div>
                <div class="h-8 bg-slate-100 rounded"></div>
                <div class="h-8 bg-slate-100 rounded"></div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Everything your hospital needs—connected
                </h2>
                <p class="mt-4 text-slate-600">Break down silos with modules that work seamlessly together and scale
                    with your operations.</p>
            </div>
            <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature Card -->
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 5v5l4 2-.75 1.86L11 13V7h2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">Patient Records (EMR)</h3>
                    <p class="mt-2 text-slate-600">Fast, searchable records with audit logs, e‑prescriptions, and
                        role‑based privacy.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path
                                d="M6 2h12v2H6V2zm12 4H6a2 2 0 00-2 2v12h2v-2h12v2h2V8a2 2 0 00-2-2zM6 14v-2h12v2H6z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">Scheduling</h3>
                    <p class="mt-2 text-slate-600">Drag‑and‑drop calendars for clinics, wards, and operating theaters
                        with wait‑list automation.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path d="M3 4h18v2H3V4zm2 4h14v12H5V8zm4 2v8h2v-8H9zm4 0v8h2v-8h-2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">Billing & Claims</h3>
                    <p class="mt-2 text-slate-600">Accurate coding, claim scrubbing, and one‑click e‑claim submissions
                        with status tracking.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path d="M4 4h16v2H4zm0 4h10v2H4zm0 4h16v2H4zm0 4h10v2H4z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">Inventory</h3>
                    <p class="mt-2 text-slate-600">Real‑time stock, low‑threshold alerts, and lot/expiry tracking for
                        pharmacy & supplies.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM2 22a10 10 0 0120 0H2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">HR & Payroll</h3>
                    <p class="mt-2 text-slate-600">Roster management, shift differentials, automated payroll, and
                        compliance training.</p>
                </div>
                <div class="p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="h-10 w-10 rounded-xl bg-emerald-100 grid place-content-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-emerald-700">
                            <path d="M3 13h2v8H3v-8zm4-6h2v14H7V7zm4 4h2v10h-2V11zm4-8h2v18h-2V3zm4 10h2v8h-2v-8z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-slate-900">Analytics</h3>
                    <p class="mt-2 text-slate-600">Command‑center dashboards for clinical, operational, and financial
                        KPIs in real time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Built with clinicians, for clinicians
                </h2>
                <p class="mt-4 text-slate-600">We partnered with hospital administrators, nurses, and physicians to
                    design workflows that reduce clicks and handoffs. Security comes standard with SSO, encryption at
                    rest and in transit, and field‑level permissions.</p>
                <ul class="mt-6 space-y-3 text-slate-700">
                    <li class="flex items-start gap-3"><span
                            class="mt-1 h-5 w-5 rounded-full bg-emerald-100 text-emerald-700 grid place-content-center">✓</span>
                        30% faster admissions & discharge workflows</li>
                    <li class="flex items-start gap-3"><span
                            class="mt-1 h-5 w-5 rounded-full bg-emerald-100 text-emerald-700 grid place-content-center">✓</span>
                        20% reduction in claims denials</li>
                    <li class="flex items-start gap-3"><span
                            class="mt-1 h-5 w-5 rounded-full bg-emerald-100 text-emerald-700 grid place-content-center">✓</span>
                        Enterprise‑grade audit trails & backups</li>
                </ul>
                <div class="mt-8 flex gap-3">
                    <a href="#pricing"
                        class="px-6 py-3 rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 font-semibold">Start
                        Free Trial</a>
                    <a href="#faq"
                        class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 font-semibold">Security
                        FAQ</a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-6 -z-10 bg-emerald-200/40 blur-2xl rounded-3xl"></div>
                <div class="p-6 bg-white border border-slate-200 rounded-2xl shadow-xl">
                    <blockquote class="text-slate-800 text-lg">
                        “Hospital IMS transformed our operations. We cut average wait time by 24% in the first quarter
                        and our clinicians love the intuitive charts.”
                    </blockquote>
                    <div class="mt-4 text-sm text-slate-500">— Dr. A. Rahman, COO, CityCare Hospitals</div>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section id="pricing" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Transparent pricing for every size</h2>
                <p class="mt-4 text-slate-600">Choose a plan and scale up anytime. All plans include secure hosting,
                    backups, and 24/7 monitoring.</p>
            </div>
            <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Starter -->
                <div class="relative rounded-2xl border border-slate-200 p-6 bg-white shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Starter</h3>
                    <p class="mt-1 text-sm text-slate-500">Clinics & small hospitals</p>
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900">৳499</span>
                        <span class="text-slate-500">/month</span>
                    </div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li class="flex gap-2">✓ Up to 50 users</li>
                        <li class="flex gap-2">✓ EMR, Scheduling, Billing</li>
                        <li class="flex gap-2">✓ Email support</li>
                    </ul>
                    <a href="#"
                        class="mt-6 block text-center w-full px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Choose
                        Starter</a>
                </div>
                <!-- Pro -->
                <div class="relative rounded-2xl border-2 border-emerald-500 p-6 bg-emerald-50 shadow-sm">
                    <div class="absolute -top-3 right-4 text-xs px-2 py-1 rounded-full bg-emerald-600 text-white">Most
                        popular</div>
                    <h3 class="text-lg font-semibold text-slate-900">Professional</h3>
                    <p class="mt-1 text-sm text-slate-600">Growing multi‑site hospitals</p>
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900">৳1,499</span>
                        <span class="text-slate-500">/month</span>
                    </div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li class="flex gap-2">✓ Unlimited users</li>
                        <li class="flex gap-2">✓ Inventory & HR modules</li>
                        <li class="flex gap-2">✓ Advanced analytics</li>
                        <li class="flex gap-2">✓ Priority chat & phone support</li>
                    </ul>
                    <a href="#"
                        class="mt-6 block text-center w-full px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Choose
                        Professional</a>
                </div>
                <!-- Enterprise -->
                <div class="relative rounded-2xl border border-slate-200 p-6 bg-white shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">Enterprise</h3>
                    <p class="mt-1 text-sm text-slate-500">Networks & teaching hospitals</p>
                    <div class="mt-6 flex items-baseline gap-1">
                        <span class="text-4xl font-extrabold text-slate-900">Custom</span>
                    </div>
                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li class="flex gap-2">✓ SSO/SAML, LDAP</li>
                        <li class="flex gap-2">✓ On‑prem or private cloud</li>
                        <li class="flex gap-2">✓ Dedicated success manager</li>
                        <li class="flex gap-2">✓ 99.9% uptime SLA</li>
                    </ul>
                    <a href="#"
                        class="mt-6 block text-center w-full px-4 py-2 rounded-xl bg-slate-900 text-white font-semibold hover:bg-slate-800">Contact
                        Sales</a>
                </div>
            </div>
            <p class="mt-6 text-center text-sm text-slate-500">All prices in USD. Taxes/VAT may apply.</p>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="max-w-2xl">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Frequently asked questions</h2>
                <p class="mt-4 text-slate-600">Have another question? <a class="text-emerald-700 font-semibold"
                        href="#">Contact us</a>.</p>
            </div>
            <div class="mt-10 grid md:grid-cols-2 gap-6">
                <details class="group rounded-xl bg-white p-5 border border-slate-200 open:shadow-sm">
                    <summary class="flex cursor-pointer items-center justify-between font-medium text-slate-900">Is my
                        data secure?
                        <span class="ml-4">➕</span>
                    </summary>
                    <div class="mt-3 text-slate-600">We use encryption at rest and in transit, per‑tenant isolation,
                        and role‑based permissions with full audit logs.</div>
                </details>
                <details class="group rounded-xl bg-white p-5 border border-slate-200 open:shadow-sm">
                    <summary class="flex cursor-pointer items-center justify-between font-medium text-slate-900">Do you
                        offer on‑prem deployments?
                        <span class="ml-4">➕</span>
                    </summary>
                    <div class="mt-3 text-slate-600">Yes. Enterprise plans support on‑prem and private cloud with our
                        team assisting in rollout and training.</div>
                </details>
                <details class="group rounded-xl bg-white p-5 border border-slate-200 open:shadow-sm">
                    <summary class="flex cursor-pointer items-center justify-between font-medium text-slate-900">Can we
                        migrate from our current EMR?
                        <span class="ml-4">➕</span>
                    </summary>
                    <div class="mt-3 text-slate-600">We provide assisted migration, data mapping, and sandbox testing
                        to ensure a smooth go‑live.</div>
                </details>
                <details class="group rounded-xl bg-white p-5 border border-slate-200 open:shadow-sm">
                    <summary class="flex cursor-pointer items-center justify-between font-medium text-slate-900">What
                        support is included?
                        <span class="ml-4">➕</span>
                    </summary>
                    <div class="mt-3 text-slate-600">All plans include a help center and email support. Pro/Enterprise
                        include priority chat and phone support.</div>
                </details>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div
                class="relative overflow-hidden rounded-2xl border border-emerald-200 bg-gradient-to-r from-emerald-600 to-teal-600 p-10 text-white">
                <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
                <h3 class="text-2xl md:text-3xl font-extrabold">Ready to modernize your hospital?</h3>
                <p class="mt-2 text-emerald-100 max-w-2xl">Join hospitals that are reducing wait times, cutting
                    denials, and boosting staff satisfaction with Hospital IMS.</p>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#pricing"
                        class="px-6 py-3 rounded-xl bg-white text-emerald-700 font-semibold hover:bg-emerald-50">Get
                        Started</a>
                    <a href="#"
                        class="px-6 py-3 rounded-xl border border-white/60 font-semibold hover:bg-white/10">Talk to
                        Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2">
                    <span
                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white font-bold">HI</span>
                    <span class="font-semibold text-slate-900">Hospital IMS</span>
                </div>
                <p class="mt-3 text-sm text-slate-600">Modern internal management software for hospitals and clinics.
                </p>
            </div>
            <div>
                <h4 class="font-semibold text-slate-900">Product</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="#features" class="hover:text-slate-900">Features</a></li>
                    <li><a href="#pricing" class="hover:text-slate-900">Pricing</a></li>
                    <li><a href="#faq" class="hover:text-slate-900">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-slate-900">Company</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="#about" class="hover:text-slate-900">About</a></li>
                    <li><a href="#" class="hover:text-slate-900">Careers</a></li>
                    <li><a href="#" class="hover:text-slate-900">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-slate-900">Legal</h4>
                <ul class="mt-4 space-y-2 text-sm">
                    <li><a href="#" class="hover:text-slate-900">Privacy</a></li>
                    <li><a href="#" class="hover:text-slate-900">Terms</a></li>
                    <li><a href="#" class="hover:text-slate-900">Security</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-200">
            <div
                class="max-w-7xl mx-auto px-4 py-6 text-sm text-slate-500 flex flex-col md:flex-row items-center justify-between">
                <p>© <span id="y"></span> Hospital IMS. All rights reserved.</p>
                <div class="flex items-center gap-4 mt-3 md:mt-0">
                    <a href="#" class="hover:text-slate-700">Status</a>
                    <a href="#" class="hover:text-slate-700">Docs</a>
                    <a href="#" class="hover:text-slate-700">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // year
        document.getElementById('y').textContent = new Date().getFullYear();
    </script>
</body>

</html>
