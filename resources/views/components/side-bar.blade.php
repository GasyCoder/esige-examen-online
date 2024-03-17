<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="#">
           <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
           Application
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav class="px-4 py-4 mt-5 lg:mt-9 lg:px-6" x-data="{selected: $persist('Accueil')}">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENUS</h3>

                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#" @click.prevent="selected = (selected === 'Accueil' ? '':'Accueil')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Accueil')}">
                            <x-mary-icon name="o-home" />
                            Accueil
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->
                    <!-- Cours/Examen -->
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Formations</h3>
                        <ul class="mb-6 flex flex-col gap-1.5">
                            <!-- Menu Cours -->
                            <li>
                                <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                    href="#" @click.prevent="selected = (selected === 'Cours' ? '':'Cours')"
                                    :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Cours') || (page === 'Matières' || page === 'Leçons') }">
                                   <x-mary-icon name="o-book-open" />
                                   Cours
                                    <svg class="absolute -translate-y-1/2 fill-current right-4 top-1/2"
                                        :class="{ 'rotate-180': (selected === 'Cours') }" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                            fill="" />
                                    </svg>
                                </a>
                                <!-- Dropdown Menu Start -->
                                <div class="overflow-hidden transform translate"
                                    :class="(selected === 'Cours') ? 'block' :'hidden'">
                                    <ul class="flex flex-col gap-2 pl-6 mt-4 mb-3">
                                        <li>
                                            <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                                href="#" :class="page === 'Matières' && '!text-white'">Matières</a>
                                        </li>

                                        <li>
                                            <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                                href="#" :class="page === 'Leçons' && '!text-white'">Leçons</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Dropdown Menu End -->
                            </li>
                            <!-- Menu Item Ui Elements -->

                            <!-- Menu Item Auth Pages -->
                            <li>
                                <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                    href="#" @click.prevent="selected = (selected === 'Examen' ? '':'Examen')"
                                    :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Examen') || (page === 'sujet' || page === 'question' || page === 'exercice') }">
                                    <x-mary-icon name="o-question-mark-circle" />
                                    Examen & Quiz

                                    <svg class="absolute -translate-y-1/2 fill-current right-4 top-1/2"
                                        :class="{ 'rotate-180': (selected === 'Examen') }" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                            fill="" />
                                    </svg>
                                </a>

                                <!-- Dropdown Menu Start -->
                                <div class="overflow-hidden transform translate"
                                    :class="(selected === 'Examen') ? 'block' :'hidden'">
                                    <ul class="flex flex-col gap-2 pl-6 mt-4 mb-3">
                                        <li>
                                            <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                                href="#" :class="page === 'sujet' && '!text-white'">Sujets</a>
                                        </li>
                                        <li>
                                            <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                                href="#" :class="page === 'question' && '!text-white'">Questions</a>
                                        </li>
                                        <li>
                                            <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                                href="#" :class="page === 'exercice' && '!text-white'">Exercices</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Dropdown Menu End -->
                            </li>
                            <!-- Menu Item Auth Pages -->
                        </ul>
                    </div>
                    <!-- Students -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="{{ route('classe') }}" @click="selected = (selected === 'Classe' ? '':'Calendar')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Classe') && (page === 'Classe') }">
                            <x-mary-icon name="o-user-group" />
                            Etudiants
                        </a>
                    </li>
                    <!-- End Students -->

                    <!-- Menu Item Profile -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="profile.html" @click="selected = (selected === 'Profile' ? '':'Profile')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Profile') && (page === 'profile') }"
                            :class="page === 'profile' && 'bg-graydark'">
                            <x-mary-icon name="o-user-circle" />
                            Utilisateurs
                        </a>
                    </li>
                    <!-- Menu Item Profile -->

                    <!-- Menu Item Donées -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#" @click.prevent="selected = (selected === 'Donées' ? '':'Donées')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Donées') || (page === 'formClasses' || page === 'formParcours') }">
                            <x-mary-icon name="o-circle-stack" />
                            Donées

                            <svg class="absolute -translate-y-1/2 fill-current right-4 top-1/2"
                            :class="{ 'rotate-180': (selected === 'Donées') }" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Donées') ? 'block' :'hidden'">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="{{ route('classe') }}" :class="page === 'formClasses' && '!text-white'">
                                        Niveau d'étude
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                                        href="#" :class="page === 'formParcours' && '!text-white'">
                                        Parcours
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Forms -->

                    <!-- Menu Item Settings -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            href="#" @click="selected = (selected === 'Settings' ? '':'Settings')"
                            :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Settings') && (page === 'settings') }"
                            :class="page === 'settings' && 'bg-graydark'">
                           <x-mary-icon name="o-cog-6-tooth" />
                            Paramètres
                        </a>
                    </li>
                    <!-- Menu Item Settings -->
                    
                </ul>
            </div>

        </nav>
        <!-- Sidebar Menu -->
        

        <!-- Developer -->
        <div
            class="absolute bottom-0 w-full px-4 py-6 mx-auto mb-5 text-center transform -translate-x-1/2 border rounded-sm left-1/2 max-w-60 border-strokedark bg-boxdark shadow-default">
            <p class="mb-0 text-xs">Version {{ config('version.current') }} - Developed by GasyCoder</p>
        </div>
        <!-- Developer -->
    </div>
</aside>