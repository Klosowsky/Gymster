-- TABLES

-- exercises
create table exercises
(
    exercise_id serial
        primary key,
    name        varchar
);

alter table exercises
    owner to dbuser;

-- logs
create table logs
(
    log_id      serial
        primary key,
    log_date    date,
    log_content varchar
);

alter table logs
    owner to dbuser;

-- privileges
create table privileges
(
    privilege_id serial
        primary key,
    name         varchar
);

alter table privileges
    owner to dbuser;

-- user_details
create table user_details
(
    user_detail_id serial
        constraint user_details_pk
            primary key,
    first_name     varchar,
    second_name    varchar,
    email          varchar,
    image          varchar default 'default_profile.jpg'::character varying
);

alter table user_details
    owner to dbuser;

-- users
create table users
(
    user_id      serial
        constraint user_user_id_key
            primary key
        constraint users_user_details_user_detail_id_fk
            references user_details,
    privilege_id integer default 2 not null
        constraint users_privileges_privilege_id_fk
            references privileges,
    username     varchar           not null
        unique,
    password     varchar           not null
);

alter table users
    owner to dbuser;

-- trainings
create table trainings
(
    training_id serial
        primary key,
    user_id     integer not null
        constraint trainings_users_user_id_fk
            references users,
    title       varchar,
    description varchar,
    likes       integer default 0,
    dislikes    integer default 0
);

alter table trainings
    owner to dbuser;

create function insert_training_logs() returns trigger
    language plpgsql
as
$$BEGIN

        IF (TG_OP = 'DELETE') THEN
            INSERT INTO public.logs(log_date, log_content) VALUES (current_date ,'trainings - DELETE - training_id: '||OLD.training_id||' training_title: '||OLD.title||' user: '||OLD.user_id);
ELSIF (TG_OP = 'INSERT') THEN
            INSERT INTO public.logs(log_date, log_content) VALUES (current_date ,'trainings - INSERT - training_id: '||NEW.training_id||' training_title: '||NEW.title||' user: '||NEW.user_id);
END IF;
RETURN NULL;
end;
$$;

alter function insert_training_logs() owner to dbuser;

create trigger after_action_on_trainings_trg
    after insert or delete
on trainings
    for each row
execute procedure insert_training_logs();

-- training_days
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

-- training_sessions
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

-- user_ratings
create table user_ratings
(
    user_id     integer
        constraint user_ratings_users_user_id_fk
            references users,
    training_id integer
        constraint user_ratings_trainings_training_id_fk
            references trainings,
    rating      integer
);

alter table user_ratings
    owner to dbuser;

-- v_trainings
create view v_trainings (training_id, user_id, username, image, title, description, likes, dislikes) as
SELECT t.training_id,
       t.user_id,
       u.username,
       ud.image,
       t.title,
       t.description,
       t.likes,
       t.dislikes
FROM trainings t
         JOIN users u ON t.user_id = u.user_id
         JOIN user_details ud ON u.user_id = ud.user_detail_id;

alter table v_trainings
    owner to dbuser;

-- v_user_data
create view v_user_data(user_id, username, user_photo, user_privilege) as
SELECT u.user_id,
       u.username,
       ud.image       AS user_photo,
       u.privilege_id AS user_privilege
FROM users u
         JOIN user_details ud ON u.user_id = ud.user_detail_id;

alter table v_user_data
    owner to dbuser;


-- DATA

-- exercises
INSERT INTO public.exercises ( name) VALUES ( 'Bench press');
INSERT INTO public.exercises ( name) VALUES ( 'Deadlift');
INSERT INTO public.exercises ( name) VALUES ( 'Dumbell press');
INSERT INTO public.exercises ( name) VALUES ( 'Jumping');
INSERT INTO public.exercises ( name) VALUES ( 'Crunch');
INSERT INTO public.exercises ( name) VALUES ( 'Face pull');
INSERT INTO public.exercises ( name) VALUES ( 'Dumbbell raise');
INSERT INTO public.exercises ( name) VALUES ( 'Front squat');
INSERT INTO public.exercises ( name) VALUES ( 'Squat');
INSERT INTO public.exercises ( name) VALUES ( 'Hammer curl');
INSERT INTO public.exercises ( name) VALUES ( 'Incline press');
INSERT INTO public.exercises ( name) VALUES ( 'Lat pulldown');
INSERT INTO public.exercises ( name) VALUES ( 'Lateral raise');
INSERT INTO public.exercises ( name) VALUES ( 'Leg press');
INSERT INTO public.exercises ( name) VALUES ( 'Muscle up');
INSERT INTO public.exercises ( name) VALUES ( 'Plank');
INSERT INTO public.exercises ( name) VALUES ( 'Pull up');
INSERT INTO public.exercises ( name) VALUES ('Push up');


-- privileges
INSERT INTO public.privileges (name) VALUES ( 'admin');
INSERT INTO public.privileges (name) VALUES ( 'normal');

-- user_details
INSERT INTO public.user_details (first_name, second_name, email, image) VALUES ('Admin', 'Admin', 'admin@gymster.com', 'admin_gymster.png');
INSERT INTO public.user_details (first_name, second_name, email) VALUES ('User', 'User', 'user@gymster.com');

-- users
INSERT INTO public.users (privilege_id, username, password) VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO public.users (privilege_id, username, password) VALUES (2, 'user', '6ad14ba9986e3615423dfca256d04e3f');

-- trainings
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (1, 'Test training', 'Test training description', 2, 0);
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (1, 'FBW - intermediate', 'This training is for intermediate people. 1-2 experience. Enjoy', 1, 1);
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (1, 'Push/pull', 'Push/pull training for people with big amount of free time. Enjoy :)', 0, 2);
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (2, 'My training', 'I am a begginer. This is my training', 0, 1);
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (2, 'Beginner training', 'This is my training for beginners.', 0, 0);
INSERT INTO public.trainings ( user_id, title, description, likes, dislikes) VALUES (2, 'Awesome training', 'This is my favourite training plan. Enjoy!', 1, 0);

-- training days
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 1, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 1, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 3);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 4);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 5);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 6);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 7);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 8);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 2, 9);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 3);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 4);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 5);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 6);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 3, 7);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 4, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 4, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 4, 3);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 4, 4);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 4, 5);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 5, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 5, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 5, 3);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 5, 4);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 5, 5);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 1);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 2);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 3);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 4);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 5);
INSERT INTO public.training_days ( training_id, day_number) VALUES ( 6, 6);

-- training_sessions
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (1, 3, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (1, 1, 2, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (1, 2, 12, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (2, 2, 2, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (2, 4, 5, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 3, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 16, 3, 1);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 17, 3, 6);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (3, 18, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (4, 5, 4, 5);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (4, 16, 2, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 7, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 15, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 17, 3, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 4, 5, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 1, 5, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (6, 16, 3, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (7, 9, 4, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (7, 17, 3, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (8, 11, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (8, 17, 3, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (8, 10, 5, 5);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (8, 16, 3, 1);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (9, 2, 5, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (9, 8, 5, 5);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (9, 12, 10, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (9, 11, 4, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (11, 6, 3, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (11, 18, 4, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (12, 4, 4, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (12, 17, 3, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (12, 15, 4, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (13, 4, 10, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (13, 17, 3, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (13, 6, 3, 8);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (13, 16, 4, 9);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (14, 2, 3, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (14, 17, 2, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (15, 3, 2, 30);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (15, 18, 5, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (15, 18, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (16, 7, 3, 20);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (16, 9, 2, 1);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (18, 4, 2, 4);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (18, 2, 4, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (18, 16, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (19, 3, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (19, 15, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (19, 15, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (20, 8, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (20, 16, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (20, 2, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (20, 18, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (22, 4, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (22, 14, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (23, 5, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (23, 12, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (23, 4, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (23, 10, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (24, 2, 2, 10);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (24, 9, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (24, 17, 4, 23);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (25, 1, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (25, 16, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (25, 14, 5, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (26, 1, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (26, 17, 3, 13);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (28, 10, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (28, 9, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (28, 3, 3, 13);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (28, 13, 4, 15);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (29, 4, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (29, 15, 3, 11);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (29, 17, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (30, 1, 3, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (30, 17, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (30, 3, 2, 11);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (31, 1, 3, 11);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (31, 5, 4, 21);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (31, 3, 4, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (33, 1, 4, 4);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (33, 1, 2, 3);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (33, 11, 12, 12);
INSERT INTO public.training_sessions (training_day_id, exercise_id, series, reps) VALUES (34, 2, 4, 2);

-- user_ratings
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (1, 1, 1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (1, 2, 1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (1, 3, -1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (2, 2, -1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (2, 1, 1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (2, 6, 1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (2, 4, -1);
INSERT INTO public.user_ratings (user_id, training_id, rating) VALUES (2, 3, -1);





