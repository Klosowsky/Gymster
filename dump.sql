create table if not exists test
(
    id integer
);

alter table test
    owner to dbuser;

create table if not exists test2
(
    id integer
);

alter table test2
    owner to dbuser;

create table if not exists exercises
(
    exercise_id serial
    primary key,
    name        varchar
);

alter table exercises
    owner to dbuser;

create table if not exists countries
(
    country_id serial
    constraint countries_pk
    primary key,
    name       varchar
);

alter table countries
    owner to dbuser;

create table if not exists user_details
(
    user_detail_id serial
    constraint user_details_pk
    primary key,
    first_name     varchar,
    second_name    varchar,
    email          varchar,
    image          varchar
);

alter table user_details
    owner to dbuser;

create table if not exists privileges
(
    privilege_id serial
    primary key,
    name         varchar
);

alter table privileges
    owner to dbuser;

create table if not exists users
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

create table if not exists trainings
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

create table if not exists training_days
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

create table if not exists training_sessions
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

create or replace view v_user_data(user_id, username, user_photo, user_privilege) as
SELECT u.user_id,
       u.username,
       ud.image       AS user_photo,
       u.privilege_id AS user_privilege
FROM users u
         JOIN user_details ud ON u.user_id = ud.user_detail_id;

alter table v_user_data
    owner to dbuser;

create or replace view v_trainings (training_id, user_id, username, image, title, description, likes, dislikes) as
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

create or replace function uuid_nil() returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_nil() owner to dbuser;

create or replace function uuid_ns_dns() returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_ns_dns() owner to dbuser;

create or replace function uuid_ns_url() returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_ns_url() owner to dbuser;

create or replace function uuid_ns_oid() returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_ns_oid() owner to dbuser;

create or replace function uuid_ns_x500() returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_ns_x500() owner to dbuser;

create or replace function uuid_generate_v1() returns uuid
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_generate_v1() owner to dbuser;

create or replace function uuid_generate_v1mc() returns uuid
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_generate_v1mc() owner to dbuser;

create or replace function uuid_generate_v3(namespace uuid, name text) returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_generate_v3(uuid, text) owner to dbuser;

create or replace function uuid_generate_v4() returns uuid
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_generate_v4() owner to dbuser;

create or replace function uuid_generate_v5(namespace uuid, name text) returns uuid
    immutable
    strict
    parallel safe
    language c
as
$$
begin
-- missing source code
end;
$$;

alter function uuid_generate_v5(uuid, text) owner to dbuser;

