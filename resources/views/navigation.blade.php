<h3 class="flex items-center font-normal text-white mb-6 text-base no-underline">
    <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="2 2 20 20">
        <path fill="var(--sidebar-icon)" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm1-8.41l2.54 2.53a1 1 0 0 1-1.42 1.42L11.3 12.7A1 1 0 0 1 11 12V8a1 1 0 0 1 2 0v3.59z"/>
    </svg>
    <span class="sidebar-label">
        {{ __('Queues') }}
    </span>
</h3>

<ul class="list-reset mb-8">
        <li class="leading-wide mb-4 text-sm">
            <router-link class="text-white ml-8 no-underline dim"
                :to="{
                    name: 'index',
                    params: {
                        resourceName: '{{ $jobsUriKey }}'
                    }
                }">
                {{ __('Jobs') }}
            </router-link>
        </li>
        <li class="leading-wide mb-4 text-sm">
            <router-link class="text-white ml-8 no-underline dim"
                :to="{
                    name: 'index',
                    params: {
                        resourceName: '{{ $failedJobsUriKey }}'
                    }
                }">
                {{ __('Failed Jobs') }}
            </router-link>
        </li>
</ul>
