<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            EITSEC Technologies Task Management System
        </h2>
    </x-slot>

    @if(session()->has('success'))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-green-900 dark:text-green-100 text-center">
                    {{ session()->get('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($errors->any())
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-red-900 dark:text-red-100 text-center">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between">
                <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                    <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class=" mr-2" role="presentation" onclick="showTasks('all')">
                            <button class="inline-flex text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            All ({{ $allCount }})
                            </button>
                        </li>
                        <li class="mr-2" role="presentation" onclick="showTasks('open')">
                            <button class="inline-flex text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512" class="mr-2">
                                <path d="M527.9 224H480v-48c0-26.5-21.5-48-48-48H272l-64-64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h400c16.5 0 31.9-8.5 40.7-22.6l79.9-128c20-31.9-3-73.4-40.7-73.4zM48 118c0-3.3 2.7-6 6-6h134.1l64 64H426c3.3 0 6 2.7 6 6v42H152c-16.8 0-32.4 8.8-41.1 23.2L48 351.4zm400 282H72l77.2-128H528z" />
                            </svg>
                            Open ({{ $open }})
                            </button>
                        </li>
                        <li class="mr-2" role="presentation" onclick="showTasks('completed')">
                            <button class="inline-flex text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" class="mr-2">
                                <path d="M152.1 38.2c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 113C-2.3 103.6-2.3 88.4 7 79s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zm0 160c9.9 8.9 10.7 24 1.8 33.9l-72 80c-4.4 4.9-10.6 7.8-17.2 7.9s-12.9-2.4-17.6-7L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l22.1 22.1 55.1-61.2c8.9-9.9 24-10.7 33.9-1.8zM224 96c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H256c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H192c-17.7 0-32-14.3-32-32zM48 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                            </svg>
                            Completed ({{ $completed }})
                            </button>
                        </li>
                    </ul>
                </div>
                    <div>
                        <button class="inline-flex items-center px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-medium rounded-md" onclick="modalHandler(true)">
                            + New Task
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center antialiased" >
                    <ul id="userTags">
                        @if(count($userTasks) >= 1)
                        @foreach($userTasks as $task)
                        <li data-type="{{ $task->status ? 'completed' : 'open' }}" class="flex justify-between box-border bg-gray-300 border rounded-md text-gray-700 mb-5 border-l-8 {{ $task->status ? 'border-green-600' : 'border-yellow-600' }}  px-4 py-4">
                            <div class="text-left truncate">
                                <div class="flex justify-around text-base leading-6 font-bold">
                                    <input onclick="updateStatus({{$task->id}})" type="checkbox" class="mr-2 relative flex h-[20px] min-h-[20px] w-[20px] min-w-[20px] appearance-none items-center 
                                        justify-center rounded-md border border-gray-300 text-white/0 outline-none transition duration-[0.2s]
                                        checked:border-none checked:text-indigo-600 hover:cursor-pointer dark:border-white/10 checked:bg-brand-500 dark:checked:bg-brand-400" name="weekly" {{ ($task->status) ? "checked" : "" }} />
                                    <p class="mr-2 w-2/3 truncate">{{ $task->title }}</p>
                                    <div class="{{ $task->status ? 'bg-green-600' : 'bg-yellow-600' }} font-medium rounded-full px-4 py-2 ">
                                        <div class="uppercase text-xs leading-4 font-semibold text-center text-yellow-100">{{ $task->status ? 'Completed' : 'Open' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <a href="{{ route('tasks.edit', $task->id) }}" class="mr-4 items-center px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
                                    Update
                                </a>
                                <div class="">
                                    <form action="{{ route('tasks.delete', $task->id) }}" method="post">
                                        @method("DELETE")
                                        @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                    </form>

                                </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                        No tasks
                        @endif


                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0" id="modal" style="display: none;">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                <div class="w-full flex justify-start text-gray-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52" height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                    </svg>
                </div>
                <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                    <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Enter Task Details</h1>
                    <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Task Name</label>
                    <input id="name" name="title" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Design Profile Page" />
                    <label for="description" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Task Description</label>
                    <textarea id="description" name="description" class="text-gray-600 mb-5 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-20 flex items-center pl-16 text-sm border-gray-300 rounded border"></textarea>

                    <div class="flex items-center justify-start w-full">
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
                    </div>
                    <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="modalHandler()" aria-label="close modal" role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @csrf
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        let modal = document.getElementById("modal");

        function modalHandler(val) {
            if (val) {
                fadeIn(modal);
            } else {
                fadeOut(modal);
            }
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }

        function updateStatus(id) {
            token = document.querySelector('input[name="_token"]').value;
            $.ajax({
            url: `tasks/${id}/updateStatus`,
            type: 'POST',
            data: { _token: token },
            success: function(data) {
                location.reload()
                console.log('Status updated successfully:');
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:');
            }
            });
        }

        function showTasks(type) {
            var userTagsUl = document.getElementById('userTags');
            if (userTagsUl) {
                var listItems = userTagsUl.querySelectorAll('li');
                listItems.forEach(function(item) {
                    // Get the data-type attribute value
                    var itemType = item.getAttribute('data-type');
                    if (type === 'all') {
                        item.style.display = 'flex';
                    }
                    else if (itemType === type) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        }
    </script>
</x-app-layout>