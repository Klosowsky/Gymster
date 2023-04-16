create table exercises
(
    exercise_id serial
        primary key,
    name        varchar
);

alter table exercises
    owner to dbuser;

INSERT INTO public.exercises (exercise_id, name) VALUES (1, 'Bench press');
INSERT INTO public.exercises (exercise_id, name) VALUES (2, 'Deadlift');

COMMIT
