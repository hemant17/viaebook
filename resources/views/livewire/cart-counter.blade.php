<button
    class="transition-fill-colors flex items-center justify-center gap-2 font-semibold duration-200 pointer-events-auto cursor-pointer opacity-100 transition-colors duration-200 text-dark-800 hover:text-dark-900 dark:hover:text-light-600 hidden sm:flex mr-4"
    aria-label="Cart"><span class="relative flex items-center"><svg viewBox="0 0 20 20" fill="none"
            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
            <path
                d="M17.8315 7.00171C17.7049 6.86414 17.5235 6.78571 17.3329 6.78571H13.9998V4.85714C13.9998 2.72993 12.2059 1 10 1C7.79414 1 6.00025 2.72993 6.00025 4.85714V6.78571H2.66712C2.47647 6.78571 2.29515 6.86414 2.16849 7.00171C2.04183 7.13929 1.9825 7.3225 2.0045 7.50443L3.13976 16.7121C3.29042 18.0164 4.42968 19 5.79026 19H14.2097C15.571 19 16.7096 18.0164 16.8596 16.7172L17.9955 7.50443C18.0175 7.32186 17.9582 7.13929 17.8315 7.00171ZM7.3335 4.85714C7.3335 3.439 8.52943 2.28571 10 2.28571C11.4706 2.28571 12.6665 3.439 12.6665 4.85714V6.78571H7.3335V4.85714ZM6.66687 9.35714C6.2989 9.35714 6.00025 9.06914 6.00025 8.71429C6.00025 8.35943 6.2989 8.07143 6.66687 8.07143C7.03485 8.07143 7.3335 8.35943 7.3335 8.71429C7.3335 9.06914 7.03485 9.35714 6.66687 9.35714ZM13.3331 9.35714C12.9651 9.35714 12.6665 9.06914 12.6665 8.71429C12.6665 8.35943 12.9651 8.07143 13.3331 8.07143C13.7011 8.07143 13.9998 8.35943 13.9998 8.71429C13.9998 9.06914 13.7011 9.35714 13.3331 9.35714Z"
                fill="currentColor"></path>
        </svg><span
            class="absolute -top-3 -right-2.5 flex min-h-[20px] min-w-[20px] shrink-0 items-center justify-center rounded-full border-2 border-light-100 bg-brand px-0.5 text-10px font-bold leading-none text-light dark:border-dark-250">{{ Cart::content()->count() }}</span></span></button>
