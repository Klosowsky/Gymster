create table users
(
    user_id      serial
        primary key
        unique
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

INSERT INTO public.users (user_id, privilege_id, username, password) VALUES (3, 1, 'test_user', 'pass');
