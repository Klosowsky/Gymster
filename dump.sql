create sequence user_user_id_seq
    as integer;

alter sequence user_user_id_seq owner to dbuser;

create table countries
(
    country_id serial
        constraint countries_pk
            primary key
        unique,
    name       varchar
);

alter table countries
    owner to dbuser;

create table user_details
(
    user_detail_id serial
        constraint user_details_pk
            primary key
        constraint user_details_pk2
            unique,
    country_id     integer not null
        constraint user_details_countries_country_id_fk
            references countries,
    first_name     varchar,
    second_name    varchar,
    email          varchar,
    image          varchar
);

alter table user_details
    owner to dbuser;

create table privileges
(
    privilege_id serial
        primary key
        unique,
    name         varchar
);

alter table privileges
    owner to dbuser;

create table users
(
    user_id      integer default nextval('user_user_id_seq'::regclass) not null
        constraint users_pk
            primary key
        constraint user_user_id_key
            unique
        constraint users_user_details_user_detail_id_fk
            references user_details,
    privilege_id integer                                               not null
        constraint users_privileges_privilege_id_fk
            references privileges,
    username     varchar                                               not null,
    password     varchar                                               not null
);

alter table users
    owner to dbuser;

alter sequence user_user_id_seq owned by users.user_id;

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

create table exercises
(
    exercise_id serial
        primary key,
    name        varchar
);

alter table exercises
    owner to dbuser;

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

