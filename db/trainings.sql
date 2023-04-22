create table trainings
(
    training_id serial
        primary key,
    user_id     integer not null
        constraint trainings_users_user_id_fk
            references users,
    title       varchar,
    description varchar
);

alter table trainings
    owner to dbuser;

INSERT INTO public.trainings (training_id, user_id, title, description) VALUES (2, 3, 'test_training', 'description of test training');


SELECT nextval(public.training_days.training_day_id);
SELECT last_value from public.training_days_training_day_id_seq;
SELECT setval('public.training_days_training_day_id_seq', 4);
