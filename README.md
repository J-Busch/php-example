Hey! I'll admit, this was a bit of an ordeal for me. Most of my experience with PHP is using Laravel using its built in authentication
and as a result, I've never built an authentication system from scratch with vanilla php before.  There are a lot of things
I would do differently next time and would fix up what I have if I had the time before sending it in to you. An example would
be moving login and registration functionallity into a single auth controller and abstracting out some of the
bigger chunks of code (some of those functions are pretty nasty) (there's also some duplicate code between reg and profile).
I'd also normally do csrf, input sanitization, and flesh out config/env stuff.

Hopefully this will run fine for you. I used Laravel's Valet dev environment with whatever Nginx configs are its defaults.
I learned quite a lot doing this and I'm confident I could accelerate quite a bit with a little guidance.

Thanks!