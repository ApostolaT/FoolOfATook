**Summary of my work**

With the current deadline, 13-07-2021, 12:00 pm my work contains all the mandatory features that the
requirements have. The code is missing some refactorization suggested by the trainer Enache. I chose to
not implement the correctur because at that time my program was not fully functional, and all the feedback
was about the coding style and best practices. 
All feedback is noted down in my agenda though, so I will take it in consideration in my future assignments.

**Requirements**

You have now reached the depths of Moria and as you already know, Pippin is a fool and this happened:
https://www.youtube.com/watch?v=5cZ4ABUo6TU

All the dark forces of Moria have now awaken and a battle is due to start.
No one knows what its outcome will be and we must step in and settle things. Once a rich and welcoming home, Moria is
now a forsaken and dark place and our heroes need some help in order to prevail.

Hopefully, we're here and we know some PHP :)

Therefore, we need to step in and clear the troubled minds of our heroes, help them gather themselves in the shadows
of Moria and let the battle commence. As it normally happens, the war consists of numerous battles and this is the case
for us as well. After each battle there will be a winning side and a losing side. Both of them will have casualties and
if the losing side had some retreating forces, they will later gather round and a new battle will commence.
This will happen until one team will slay all its enemies.

The battle can go both ways so we can only hope that our fellowship will prevail at the end of this war.

Technical requirements:
- All living beings in Moria are ChildrenOfIluvatar and have the following traits:
    - Name
    - A certain level of strength (float between 0 and 1)
    - A certain level of intelligence (float between 0 and 1)
    - A certain level of charisma (float between 0 and 1)
    - A certain level of fightPower (float between 0 and 100)
        - the fightPower is calculated in a different way depending of each living being
        - when a battles commences, the one with the biggest fightPower wins. However, there's a 1% chance that the one
          with the less fightPower will win (because of luck)

- There are the following living beings involved in the battle:
    - Hobbit
        - member of the good army
        - fightPower = 10 * strength + 20 * intelligence + 20 * charisma
    - Elf
        - member of the good army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 30 * strength + 30 * intelligence + 5 * charisma + 10 * supernatural
    - Man
        - member of the good army
        - fightPower = 30 * strength + 30 * intelligence + 10 * charisma
    - Dwarf
        - member of the good army
        - fightPower = 40 * strength + 10 * intelligence + 10 * charisma
    - Wizard
        - member of the good army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 20 * strength + 30 * intelligence + 5 * charisma + 20 * supernatural
    - Goblin
        - member of the evil army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 20 * strength + 10 * intelligence + 1 * charisma + 5 * supernatural
    - Orc
        - member of the evil army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 30 * strength + 10 * intelligence + 1 * charisma + 5 * supernatural
    - Trol
        - member of the evil army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 50 * strength + 1 * intelligence + 1 * charisma + 10 * supernatural
    - Balrog
        - member of the evil army
        - Extra trait: a certain level of supernatural abilities (float between 0 and 1)
        - fightPower = 60 * strength + 5 * intelligence + 1 * charisma + 30 * supernatural

Each ChildrenOfIluvatar needs to be one of the above and can't exist as a standalone entity.

Please create a PHP script that will manage the battle of Moria.

**anchor 1**

The battle will start by defining the two armies. Initially, the member of both armies are scrambled in an input text
file called moria.txt that holds an array of serialized ChildrenOfIluvatar. You will need to read and deserialize
the input file and then create the two armies of good and evil. Careful, if you come across a Balrog in the serialized
file, you'll need to run away from it and ignore it (do not add it in the army) since our heroes are not
yet prepared to face such a force.

After the two armies are defined, the battle will commence the following way: each member of the two sides will randomly
face an opponent from the other side (defining the random function is up to you). If one army is greater than the other
and there is no one left to fight with, then the surplus powers will stay idle and won't fight this battle.
The winner will be the one that has the greatest fightPower.
The loser will either retreat or die based on a random value that is up to you to define.

The battle will finish when all the soldiers of one team will be either dead or retreating and that will be the losing
side. After each battle, all the remaining living forces (both good and evil) will be scrambled and serialized in the
same file called moria.txt (overriding the initial data). In addition to the remaining forces, there is a chance that
a Balrog will sneak in from the shadows (the chance is up to you to calculate).

While one battle is over, the war of Moria still goes on since the retreating side will gather round and go for another
attack. The war will be over when all the soldiers of one army are dead.

Therefore, we will repeat the same steps from *anchor1 until there is no further battle to fight.

Extra notes:
- please be verbose when running the application
- please create a separate script that will populate the input file with random values
- please handle errors and exceptions