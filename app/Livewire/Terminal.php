<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Terminal extends Component
{
    public string $input = '';

    public array $output = [];

    // History of all user input
    public array $history = [];

    public int $historyIndex = 0;

    public string $hostname = '<span class="text-orange-300">guest</span>@<span class="text-fuchsia-300">jasonferenbach.com</span>:~$ ';

    protected $listeners = ['previous', 'next'];

    public function mount(): void
    {
        // Show banner on initial load
        $this->run('banner');
    }

    public function previous()
    {
        if (array_key_exists($this->historyIndex + 1, $this->history)) {
            $this->historyIndex++;
            $this->input = $this->history[$this->historyIndex];
        }
    }

    public function next()
    {
        if ($this->historyIndex == 0) {
            $this->input = $this->history[0];
        } elseif (array_key_exists($this->historyIndex - 1, $this->history)) {
            $this->historyIndex--;
            $this->input = $this->history[$this->historyIndex];
        }
    }

    public function hostname($command)
    {
        return $this->output[] = $this->hostname.'<span class="ml-2 text-rose-400">'.$command.'</span>';
    }

    public function run($command)
    {
        if ($command == 'banner') {
            return $this->hostname($command).$this->output[] = '<div class="bg-gradient-to-t bg-clip-text text-transparent from-orange-300 to-purple-500">
             <pre class="-mb-2">•       ┏        ┓    ┓        </pre>
             <pre class="-mb-2">┓┏┓┏┏┓┏┓╋┏┓┏┓┏┓┏┓┣┓┏┓┏┣┓ ┏┏┓┏┳┓</pre>
             <pre class="-mb-2">┃┗┻┛┗┛┛┗┛┗ ┛ ┗ ┛┗┗┛┗┻┗┛┗•┗┗┛┛┗┗</pre>
             <pre class="-mb-2">┛                              </pre>
             </div>
             <p class="mt-4">Welcome to jasonferenbach.com v1.0.4</p>
             Type <span class="text-fuchsia-300 glow">\'help\'</span> for a list of available commands.</p>
             <p class="mt-8">Type <span class="text-fuchsia-300 glow">\'repo\'</span> to view the GitHub repository, or click <a href="https://github.com/jasonferenbach/jasonferenbach.com"><spam class="text-red-300 underline hover:bg-orange-300 hover:text-gray-800">here</span></a>.</p>';
        }

        if ($command == 'help') {
            return $this->hostname($command).$this->output[] = '<div class="ml-4 space-y-4">
                <ul>
                    <li class="flex">
                        <div class="w-36"><span class="glow text-fuchsia-300">\'whoami\'</span></div>
                        <div>About me</div>
                    </li>
                    <li class="flex">
                        <div class="w-36"><span class="glow text-fuchsia-300">\'banner\'</span></div>
                        <div>Display banner</div>
                    </li>
                    <li class="flex">
                        <div class="w-36"><span class="glow text-fuchsia-300">\'clear\'</span></div>
                        <div>Clear terminal</div>
                    </li>
                </ul>

                <div>
                    <p>Press <span class="text-orange-300">[Esc]</span> to clear entered text.</p>
                    <p>Press <span class="text-orange-300">[&uarr;][&darr;]</span> to scroll through history of commands.</p>
                </div>
            </div>';
        }

        if ($command == 'whoami') {
            return $this->hostname($command).$this->output[] = '<div id="element" class="ml-4 space-y-4">
            <ul>
                <li class="flex">
                    <div class="w-36 flex items-center text-gray-100">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                        </svg>
                        <span class="text-gray-100">Email</span>
                    </div>
                    <div class="underline hover:bg-orange-300 hover:text-gray-800">
                        <a href="mailto:jason@jasonferenbach.com">
                            jason@jasonferenbach.com
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="w-36 flex items-center text-gray-100">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Github</span>
                    </div>
                    <div class="underline hover:bg-orange-300 hover:text-gray-800">
                        <a href="https://github.com/jasonferenbach" target="_blank">
                            github.com/jasonferenbach
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="w-36 flex items-center text-gray-100">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M 12 2 C 6.82 2 2.5507812 5.95 2.0507812 11 L 7.0195312 13.759766 C 7.5495313 13.289766 8.24 13 9 13 C 9.03 13 9.0500781 13.009766 9.0800781 13.009766 C 9.6800781 12.089766 10.449766 10.919609 11.009766 10.099609 C 11.009766 10.059609 11 10.03 11 10 C 11 8.93 11.419922 7.9299219 12.169922 7.1699219 C 13.679922 5.6599219 16.320078 5.6599219 17.830078 7.1699219 C 18.580078 7.9299219 19 8.93 19 10 C 19 11.07 18.580078 12.070078 17.830078 12.830078 C 17.070078 13.580078 16.07 14 15 14 C 14.97 14 14.930391 13.990234 14.900391 13.990234 C 14.080391 14.550234 12.910234 15.319922 11.990234 15.919922 C 11.990234 15.949922 12 15.97 12 16 C 12 17.66 10.66 19 9 19 C 7.34 19 6 17.66 6 16 C 6 15.83 6.0107812 15.66 6.0507812 15.5 L 2.0898438 13.300781 C 2.7198438 18.210781 6.92 22 12 22 C 17.52 22 22 17.52 22 12 C 22 6.48 17.52 2 12 2 z M 6.0507812 15.5 L 8.5097656 16.869141 C 8.6697656 16.959141 8.83 17 9 17 C 9.35 17 9.6891406 16.810234 9.8691406 16.490234 C 10.139141 16.000234 9.9702344 15.390859 9.4902344 15.130859 L 7.0195312 13.759766 C 6.5095312 14.189766 6.1607813 14.81 6.0507812 15.5 z M 15 8 A 2 2 0 0 0 15 12 A 2 2 0 0 0 15 8 z"></path>
                        </svg>
                        <span>Steam</span>
                    </div>
                    <div class="underline hover:bg-orange-300 hover:text-gray-800">
                        <a href="https://steamcommunity.com/id/zerotwonine/" target="_blank">
                            steamcommunity.com/id/zerotwonine
                        </a>
                    </div>
                </li>
            </ul>
            <ul class="space-y-4">
                <li>
                    <div>
                        <p><span class="glow text-red-300">PGP public key fingerprint</span><br>
                        462B 7EC5 59C3 39DE 1054 2E8F 2DC0 A8CA BCF8 9FCE
                    </div>
                </li>
            </ul>
        </div>';
        }

        if ($command == 'repo') {
            return $this->redirect('https://github.com/jasonferenbach/jasonferenbach.com');
        }

        if ($command == 'clear') {
            return $this->output = [];
        }

        // If no matching command
        return $this->hostname($command).$this->output[] = '<span class="text-white">COMMAND NOT FOUND</span><br>Type <span class="text-fuchsia-300">\'help\'</span> to get started.</span>';
    }

    public function submit()
    {
        // Format input
        $command = trim(strtolower($this->input));

        if (! empty($command)) {

            // Save command to history
            unset($this->history[0]);
            array_unshift($this->history, $command);
            array_unshift($this->history, '');

            $this->run($command);

            // Keep only the last 15 items in the output array
            $this->output = array_slice($this->output, -15, 15);

            // Clear the terminal input after every command
            $this->reset('input');

            // Send event to terminal to set focus back to terminal input
            $this->dispatch('outputUpdated');
        } else {
            // Output hostname and command
            return $this->output[] = $this->hostname.$command;
        }
    }

    public function render(): View
    {
        return view('livewire.terminal');
    }
}
