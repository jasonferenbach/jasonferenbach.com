<div x-data="{ historyIndex: @entangle('historyIndex') }" x-init="$refs.terminalInput.focus()" x-on:click="$refs.terminalInput.focus()" class="h-screen w-screen border-solid p-1 sm:p-3 bg-indigo-800/20">
    <div id="header" class="flex justify-center bg-gradient-to-b from-purple-500/40 bg-purple-300 rounded-t-sm h-11 p-3 text-sm">
        guest@jasonferenbach.com
    </div>
    <div id="terminalScreen" x-ref="terminalScreen" class="h-[calc(100%-2.6rem)] -mt-0.5 w-full border-x-2 border-b-2 rounded-b-sm border-t border-purple-300 overflow-scroll hide-scrollbar">
        <div class="p-4 text-pink-100/75">
            <div id="terminal" class="mb-5">
                @foreach ($output as $line)
                    <div class="flex mb-5">
                        <div class="relative text-pink-100/75 overflow-hidden">
                            @if (strpos($line, 'text-fuchsia-400') !== false)
                                {!! $line !!}
                            @else
                                <p>
                                    {!! $line !!}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <div class="flex">
                    <div>
                        <div class="flex mr-2">
                            <div class="text-orange-300">guest</div>
                            <div>@</div>
                            <div class="text-fuchsia-300">jasonferenbach.com</div>
                            <div class="whitespace-nowrap">:~$</div>
                        </div>
                    </div>
                    <div class="ml-2 -mb-2 text-orange-400">
                        <form wire:submit.prevent="submit" x-on:submit="historyIndex = 0;">
                            <input id="terminalInput" x-on:keydown.up.window="$dispatch('previous')" x-on:keydown.down.window="$dispatch('next')"x-on:keydown.escape="$dispatch('clearInput')" x-ref="terminalInput" maxlength="20" wire:model="input" type="text" spellcheck="false" autocomplete="off" class="bg-transparent focus:outline-none focus:shadow-none w-full text-rose-400 pl-0.5">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden text-xxs -mb-3.5 space-y-2 -mt-0.5 -mt-1 mt-3 text-gray-100 hover:text-gray-800 mr-2 underline items-center ml-4 h-4 w-4 text-xxxs sm:text-xxs w-36 space-y-4 from-orange-300 to-purple-500 text-red-300 hover:bg-orange-300 mt-3 mt-4 bg-gradient-to-t bg-clip-text text-transparent
    from-teal-300 via-green-400 to-purple-500 animate-typing overflow-hidden"></div>

    @script
    <script>
        $wire.on('outputUpdated', () => {
            setTimeout(() => {
                $refs.terminalScreen.scrollTop = 100000;
            }, 10);
        });
    </script>
    @endscript
</div>
