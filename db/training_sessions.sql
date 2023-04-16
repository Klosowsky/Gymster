create table training_sessions
(
    training_day_id integer
        constraint training_sessions_training_days_training_day_id_fk
            references training_days,
    exercise_id     integer
        constraint training_sessions_exercises_exercise_id_fk
            references exercises,
    series          integer,
    reps            integer
);

alter table training_sessions
    owner to dbuser;

INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (1, 1, 3, 8);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (1, 2, 4, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (2, 1, 3, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 2, 2, 9);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 1, 5, 3);
