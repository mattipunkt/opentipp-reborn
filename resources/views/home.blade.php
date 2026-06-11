<x-layout>
    <h1 class="text-4xl font-bold mb-2">
        Startseite
    </h1>
    <div class="grid md:grid-cols-3 grid-cols-1 gap-2 mb-3">
        <div class="card card-border bg-base-200 shadow">
            <div class="card-body">
                <h4 class="text-2xl font-bold">
                    Nächste Spiele
                </h4>
                    @foreach ($nextGames as $game)
                        <a class="hover:underline underline-offset-4 transition-all" href="/match/{{ $game->id }}">
                            <div class="mt-2">
                                <div class="text-center font-medium">
                                    {{ $game->time->format('d.m.Y,  H:i') }} Uhr
                                </div>
                                <div class="flex justify-center">
                                    <div class="">
                                        {{ $game->team1->name }}
                                    </div>
                                    <span> -   </span>
                                    <div class="">
                                        {{ $game->team2->name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @auth
                        @if(!$game->vote(auth()->user()->id, $game->id))
                            <div class="flex justify-center">
                                <div class="badge badge-warning items-center align-center justify-center">
                                    Noch kein Tipp vorhanden!
                                </div>
                            </div>
                        @endif
                    @endauth
                    @endforeach
            </div>
        </div>
        <div class="card card-border bg-base-200 shadow">
            <div class="card-body">
                <h4 class="text-2xl font-bold">Letzte Spiele</h4>
                @foreach($lastGames as $game)
                    <a class="hover:underline underline-offset-4 transition-all" href="/match/{{ $game->id }}">
                    <div class="m-1">
                        <div class="text-center font-medium">
                            {{ $game->time->format('d.m.Y,  H:i') }} Uhr
                        </div>
                        <div class="flex justify-center">
                            <div class="">
                                {{ $game->team1->name }}
                            </div>
                            <span class="mx-1 italic"> ({{ $game->team1_score }} - {{ $game->team2_score }}) </span>
                            <div class="">
                                {{ $game->team2->name }}
                            </div>
                        </div>
                    </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="card card-border bg-base-200 shadow">
                <div class="card-body">
                    <a href="/ranks" class="link-body-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                        <h4 class="text-2xl font-bold align-center">Punktetabelle
                             <i class=" text-lg bi bi-box-arrow-up-right fs-6 align-middle items-center"></i>
                        </h4>
                    </a>

                    @foreach($users as $user)
                        <a class="card card-border bg-base-100 shadow" href="/user/{{ $user->name }}">
                            <div class="card-body py-3 px-2">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div class="align-middle">
                                            @if($user->profile_picture)
                                                <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-full shadow align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                                            @else
                                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAMISURBVGiB7djfi5RVHMfxl5YuEvlj3Sx/gBFkkVuWpQSh4a8wKehOFkMMoSC6LFgjiO4kiKK7sOwfKNaL/oCuAgtRQUQEdUV21SJS1HXTtrw4Z5jzrDOz88zzzA7B84YDZ2a+3+/5nGee8z3ne6ioqKj4PzGnS3GX4g28guXxu3H8gp/wZ5fGLY1+fIlJ/NekTeILLOmRxhkZxHnNJzC9ncPasgYv69V6AkcxkHw3hhGcjZ+fwltYmdj8gY0YLUlHIR7ACfUn/Q+GMb+BbR8ORJua/bEYo+fsVxf1L3a34TMUbWt++7olLg/H1AUdyuF3OPH7rQu6crFK9sk+mcN3jew/uaJ0dTnYloi50IH/xcR/axEhc4s4Y1nSv9yB/1jSf7SIkKITuZb0F3fgn26KfxXUUohnZNPuQGvzDI/IpuGnS1eXk1F1MR/n8Psk8Ttfvqz8fKYu6AaebcPnOdxM/D7tmrocLMTv6qKuYFML+83RJrV/uMsa22Y77sruCz8Iu/xgbLvxo+y+cwdbeqC3JUO4rf3T74T2jjM9YQN+NfMkjuLFHmlsmznYhe9wWkgAN2L/W7yue5VpRUXZlPWu9uF5vCQc5R8Xbk/mYVG0uS6k6HHh1HtWqGVO4O+SdHREH97GESGVtpt2G6XhEeyJMWeNBcKZ6moB8c3aVaGmX5BXVN5Xawu+x+oGv03gOE4KB8kx3IoNHoptVfRfh/VNRI/iHfycU19bfIQp2Sd4U6jTdwjrIS/z8Jqwv9yaFnsKHxZWPY3haYNM4qBybwv78bmw8NOxhssaYKdsATSGl8sK3oD1srX8FN4sGvQxIW3Wgp5Rv5TuJsvjWLVxrylY03+dBLsulLazxRqhjq+N/1WngQZkb9XfL0NdTj6QXZdLOwmyLwlySWdZqSjzhTVZ07G3mWGr66DNSX9EOF7MNnfi2DVebWb4YIsg6aIewLsFRXVKf9Jveq3aaiLjSX8otl4zPrPJ/byg2GGw7DYRNTVkprPWIN7T+1vAM/gGp3qso6KioqIk7gFDQi8ogTCjPQAAAABJRU5ErkJggg==" class="rounded-circle align-middle" style="height: 40px; object-fit: contain; object-position: 100% 0;margin-right:5px" alt="{{ $user->name }}">
                                            @endif
                                        </div>
                                        <div class="ml-2 align-middle items-center font-medium">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <div class="font-semibold text-md">{{ $user->points }}</div>
                                </div>
                            </div>

                        </a>

                    @endforeach
                </div>
        </div>
        @auth
        <div class="card card-border bg-base-200 shadow">
            <div class="card-body">
                <h4 class="card-title">Dein Punktestand</h4>
                <p class="card-text">
                    Du hast gerade {{ Auth::user()->points }} Punkte.
                </p>
            </div>
        </div>
        @endauth
    </div>

</x-layout>
