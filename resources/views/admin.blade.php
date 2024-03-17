<x-app-layout>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <x-mary-icon name="o-user-group" />
                </div>

                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h4 class="font-bold text-black text-title-md dark:text-white">
                            30
                        </h4>
                        <span class="text-sm font-medium">Total étudiants</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End -->

            <!-- Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                   <x-mary-icon name="o-user-group" />
                </div>

                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h4 class="font-bold text-black text-title-md dark:text-white">
                            50
                        </h4>
                        <span class="text-sm font-medium">Total matières</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End -->

            <!-- Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <x-mary-icon name="o-user-group" />
                </div>

                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h4 class="font-bold text-black text-title-md dark:text-white">
                            30
                        </h4>
                        <span class="text-sm font-medium">Total sujets</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End -->

            <!-- Card Item Start -->
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <x-mary-icon name="o-user-group" />
                </div>

                <div class="flex items-end justify-between mt-4">
                    <div>
                        <h4 class="font-bold text-black text-title-md dark:text-white">
                            40
                        </h4>
                        <span class="text-sm font-medium">Total utilisateurs</span>
                    </div>

                </div>
            </div>
            <!-- Card Item End -->
        </div>
        {{-- here --}}
        <div class="mt-4 bg-white border rounded-sm border-stroke shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke px-4 py-4 dark:border-strokedark sm:px-6 xl:px-7.5">
                <h3 class="font-medium text-black dark:text-white">
                    Notifications
                </h3>
            </div>
            
            <div class="p-4 sm:p-6 xl:p-10">
                <div class="max-w-[100%] rounded-lg border border-stroke py-6 pl-4 pr-5.5 dark:border-strokedark dark:bg-meta-4 sm:pl-6">
                    
                    <div class="flex justify-between">
                        <div class="flex flex-grow gap-6">

                            <div>
                                <h4 class="mb-2 font-medium text-black text-title-xsm dark:text-white">
                                    New update! available
                                </h4>
                                <p class="font-medium">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing
                                    elit. Nullam nec ligula at dolor aliquam mollis.
                                </p>
                                <button class="mt-5 font-medium text-primary">
                                    Update now
                                </button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>
