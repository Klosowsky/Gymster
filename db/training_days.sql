create table training_days
(
    training_day_id serial
        primary key,
    training_id     integer
        constraint training_days_trainings_training_id_fk
            references trainings,
    day_number      integer
);

alter table training_days
    owner to dbuser;

INSERT INTO public.training_days (training_day_id, training_id, day_number) VALUES (1, 2, 1);
INSERT INTO public.training_days (training_day_id, training_id, day_number) VALUES (2, 2, 2);
INSERT INTO public.training_days (training_day_id, training_id, day_number) VALUES (3, 2, 3);
