PGDMP      ,                |            intercambio    16.3    16.3 Y    f           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            g           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            h           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            i           1262    16398    intercambio    DATABASE        CREATE DATABASE intercambio WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Mexico.1252';
    DROP DATABASE intercambio;
                postgres    false            �            1259    16399    administrador    TABLE     �   CREATE TABLE public.administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);
 !   DROP TABLE public.administrador;
       public         heap    postgres    false            �            1259    16404    chat    TABLE     �   CREATE TABLE public.chat (
    id integer NOT NULL,
    usuario_emisor_id integer,
    usuario_emisor character varying(100),
    usuario_receptor_id integer,
    usuario_receptor character varying(100),
    mensaje text
);
    DROP TABLE public.chat;
       public         heap    postgres    false            �            1259    16409    chat_id_seq    SEQUENCE     �   CREATE SEQUENCE public.chat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.chat_id_seq;
       public          postgres    false    216            j           0    0    chat_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.chat_id_seq OWNED BY public.chat.id;
          public          postgres    false    217            �            1259    16410    libro    TABLE     �  CREATE TABLE public.libro (
    id integer NOT NULL,
    titulo character varying(50),
    autor character varying(100),
    isbn character varying(50),
    estatus boolean DEFAULT true,
    estado_fisico character varying(10),
    imagen_portada character varying(255),
    sinopsis text,
    editorial character varying(100),
    num_paginas integer,
    poseedor_id integer,
    categorias character varying(250),
    idioma character varying(30)
);
    DROP TABLE public.libro;
       public         heap    postgres    false            �            1259    16416    libro_id_seq    SEQUENCE     �   CREATE SEQUENCE public.libro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.libro_id_seq;
       public          postgres    false    218            k           0    0    libro_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.libro_id_seq OWNED BY public.libro.id;
          public          postgres    false    219            �            1259    16417    lista_espera    TABLE     u   CREATE TABLE public.lista_espera (
    id_lista integer NOT NULL,
    id_libro integer,
    id_estudiante integer
);
     DROP TABLE public.lista_espera;
       public         heap    postgres    false            �            1259    16420    lista_espera_lista_id_seq    SEQUENCE     �   CREATE SEQUENCE public.lista_espera_lista_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.lista_espera_lista_id_seq;
       public          postgres    false    220            l           0    0    lista_espera_lista_id_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.lista_espera_lista_id_seq OWNED BY public.lista_espera.id_lista;
          public          postgres    false    221            �            1259    16554    mensajes    TABLE     �   CREATE TABLE public.mensajes (
    id integer NOT NULL,
    id_intercambio integer,
    id_enviado integer,
    mensaje text,
    fecha_envio timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.mensajes;
       public         heap    postgres    false            �            1259    16553    mensajes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.mensajes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.mensajes_id_seq;
       public          postgres    false    233            m           0    0    mensajes_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.mensajes_id_seq OWNED BY public.mensajes.id;
          public          postgres    false    232            �            1259    16421    prestamo    TABLE     s  CREATE TABLE public.prestamo (
    id integer NOT NULL,
    usuario_solicitante_id integer,
    usuario_solicitante character varying(100),
    usuario_prestamista_id integer,
    usuario_prestamista character varying(100),
    fecha_prestamo timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fecha_devolucion timestamp without time zone,
    libro_emisor_id integer,
    libro_emisor character varying(100),
    libro_receptor_id integer,
    libro_receptor character varying(100),
    fecha_inicio_prestamo timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fecha_fin_prestamo timestamp without time zone
);
    DROP TABLE public.prestamo;
       public         heap    postgres    false            �            1259    16426    prestamo_id_seq    SEQUENCE     �   CREATE SEQUENCE public.prestamo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.prestamo_id_seq;
       public          postgres    false    222            n           0    0    prestamo_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.prestamo_id_seq OWNED BY public.prestamo.id;
          public          postgres    false    223            �            1259    16535    registro_admin    TABLE     �  CREATE TABLE public.registro_admin (
    id integer NOT NULL,
    nombre_completo character varying(100) NOT NULL,
    correo_electronico character varying(100) NOT NULL,
    numero_telefono character varying(20) NOT NULL,
    codigo_academicos character varying(20) NOT NULL,
    "contraseña" character varying(100) NOT NULL,
    razon text NOT NULL,
    fecha_registro timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
 "   DROP TABLE public.registro_admin;
       public         heap    postgres    false            �            1259    16534    registro_admin_id_seq    SEQUENCE     �   CREATE SEQUENCE public.registro_admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.registro_admin_id_seq;
       public          postgres    false    230            o           0    0    registro_admin_id_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.registro_admin_id_seq OWNED BY public.registro_admin.id;
          public          postgres    false    229            �            1259    16427    reportes    TABLE     }  CREATE TABLE public.reportes (
    id integer NOT NULL,
    usuario_reportante_id integer,
    usuario_reportante character varying(100),
    usuario_reportado_id integer,
    usuario_reportado character varying(100),
    descripcion text,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(100),
    foto_libro character varying(255)
);
    DROP TABLE public.reportes;
       public         heap    postgres    false            �            1259    16433    reportes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reportes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.reportes_id_seq;
       public          postgres    false    224            p           0    0    reportes_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.reportes_id_seq OWNED BY public.reportes.id;
          public          postgres    false    225            �            1259    16565    resenas    TABLE     �   CREATE TABLE public.resenas (
    id integer NOT NULL,
    id_usuario integer,
    mensaje text,
    fecha date,
    calificacion integer,
    id_critico integer
);
    DROP TABLE public.resenas;
       public         heap    postgres    false            �            1259    16564    resenas_id_seq    SEQUENCE     �   CREATE SEQUENCE public.resenas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.resenas_id_seq;
       public          postgres    false    235            q           0    0    resenas_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.resenas_id_seq OWNED BY public.resenas.id;
          public          postgres    false    234            �            1259    16527    solicitud_administrador    TABLE     �   CREATE TABLE public.solicitud_administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);
 +   DROP TABLE public.solicitud_administrador;
       public         heap    postgres    false            �            1259    16544    solicitud_prestamos    TABLE       CREATE TABLE public.solicitud_prestamos (
    id integer DEFAULT nextval('public.libro_id_seq'::regclass) NOT NULL,
    id_libro integer,
    id_solicitante integer,
    id_propietario integer,
    status_solicitante character varying,
    status_propietario character varying
);
 '   DROP TABLE public.solicitud_prestamos;
       public         heap    postgres    false    219            �            1259    16434    usuarios    TABLE     J  CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    telefono character varying(20),
    codigo_estudiante character varying(20),
    foto_perfil character varying(255),
    foto_credencial character varying(255),
    strikes integer DEFAULT 0,
    baneado boolean DEFAULT false,
    fecha_baneo timestamp without time zone,
    baneado_permanente boolean DEFAULT false,
    estado character varying(50) DEFAULT 'usuario no registrado'::character varying
);
    DROP TABLE public.usuarios;
       public         heap    postgres    false            �            1259    16443    usuarios_id_seq    SEQUENCE     �   CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.usuarios_id_seq;
       public          postgres    false    226            r           0    0    usuarios_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;
          public          postgres    false    227            �           2604    16444    chat id    DEFAULT     b   ALTER TABLE ONLY public.chat ALTER COLUMN id SET DEFAULT nextval('public.chat_id_seq'::regclass);
 6   ALTER TABLE public.chat ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    216            �           2604    16445    libro id    DEFAULT     d   ALTER TABLE ONLY public.libro ALTER COLUMN id SET DEFAULT nextval('public.libro_id_seq'::regclass);
 7   ALTER TABLE public.libro ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    218            �           2604    16446    lista_espera id_lista    DEFAULT     ~   ALTER TABLE ONLY public.lista_espera ALTER COLUMN id_lista SET DEFAULT nextval('public.lista_espera_lista_id_seq'::regclass);
 D   ALTER TABLE public.lista_espera ALTER COLUMN id_lista DROP DEFAULT;
       public          postgres    false    221    220            �           2604    16557    mensajes id    DEFAULT     j   ALTER TABLE ONLY public.mensajes ALTER COLUMN id SET DEFAULT nextval('public.mensajes_id_seq'::regclass);
 :   ALTER TABLE public.mensajes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    232    233    233            �           2604    16447    prestamo id    DEFAULT     j   ALTER TABLE ONLY public.prestamo ALTER COLUMN id SET DEFAULT nextval('public.prestamo_id_seq'::regclass);
 :   ALTER TABLE public.prestamo ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    222            �           2604    16538    registro_admin id    DEFAULT     v   ALTER TABLE ONLY public.registro_admin ALTER COLUMN id SET DEFAULT nextval('public.registro_admin_id_seq'::regclass);
 @   ALTER TABLE public.registro_admin ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    230    230            �           2604    16448    reportes id    DEFAULT     j   ALTER TABLE ONLY public.reportes ALTER COLUMN id SET DEFAULT nextval('public.reportes_id_seq'::regclass);
 :   ALTER TABLE public.reportes ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224            �           2604    16568 
   resenas id    DEFAULT     h   ALTER TABLE ONLY public.resenas ALTER COLUMN id SET DEFAULT nextval('public.resenas_id_seq'::regclass);
 9   ALTER TABLE public.resenas ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    234    235    235            �           2604    16449    usuarios id    DEFAULT     j   ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);
 :   ALTER TABLE public.usuarios ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    226            O          0    16399    administrador 
   TABLE DATA           l   COPY public.administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
    public          postgres    false    215   4q       P          0    16404    chat 
   TABLE DATA           u   COPY public.chat (id, usuario_emisor_id, usuario_emisor, usuario_receptor_id, usuario_receptor, mensaje) FROM stdin;
    public          postgres    false    216   �q       R          0    16410    libro 
   TABLE DATA           �   COPY public.libro (id, titulo, autor, isbn, estatus, estado_fisico, imagen_portada, sinopsis, editorial, num_paginas, poseedor_id, categorias, idioma) FROM stdin;
    public          postgres    false    218   �q       T          0    16417    lista_espera 
   TABLE DATA           I   COPY public.lista_espera (id_lista, id_libro, id_estudiante) FROM stdin;
    public          postgres    false    220   |       a          0    16554    mensajes 
   TABLE DATA           X   COPY public.mensajes (id, id_intercambio, id_enviado, mensaje, fecha_envio) FROM stdin;
    public          postgres    false    233   -|       V          0    16421    prestamo 
   TABLE DATA             COPY public.prestamo (id, usuario_solicitante_id, usuario_solicitante, usuario_prestamista_id, usuario_prestamista, fecha_prestamo, fecha_devolucion, libro_emisor_id, libro_emisor, libro_receptor_id, libro_receptor, fecha_inicio_prestamo, fecha_fin_prestamo) FROM stdin;
    public          postgres    false    222   J|       ^          0    16535    registro_admin 
   TABLE DATA           �   COPY public.registro_admin (id, nombre_completo, correo_electronico, numero_telefono, codigo_academicos, "contraseña", razon, fecha_registro) FROM stdin;
    public          postgres    false    230   g|       X          0    16427    reportes 
   TABLE DATA           �   COPY public.reportes (id, usuario_reportante_id, usuario_reportante, usuario_reportado_id, usuario_reportado, descripcion, fecha, estado, foto_libro) FROM stdin;
    public          postgres    false    224   (}       c          0    16565    resenas 
   TABLE DATA           [   COPY public.resenas (id, id_usuario, mensaje, fecha, calificacion, id_critico) FROM stdin;
    public          postgres    false    235   E}       \          0    16527    solicitud_administrador 
   TABLE DATA           v   COPY public.solicitud_administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
    public          postgres    false    228   �}       _          0    16544    solicitud_prestamos 
   TABLE DATA           �   COPY public.solicitud_prestamos (id, id_libro, id_solicitante, id_propietario, status_solicitante, status_propietario) FROM stdin;
    public          postgres    false    231   �}       Z          0    16434    usuarios 
   TABLE DATA           �   COPY public.usuarios (id, nombre_completo, correo, "contraseña", telefono, codigo_estudiante, foto_perfil, foto_credencial, strikes, baneado, fecha_baneo, baneado_permanente, estado) FROM stdin;
    public          postgres    false    226   �}       s           0    0    chat_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.chat_id_seq', 1, false);
          public          postgres    false    217            t           0    0    libro_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.libro_id_seq', 106, true);
          public          postgres    false    219            u           0    0    lista_espera_lista_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.lista_espera_lista_id_seq', 12, true);
          public          postgres    false    221            v           0    0    mensajes_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.mensajes_id_seq', 46, true);
          public          postgres    false    232            w           0    0    prestamo_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.prestamo_id_seq', 1, false);
          public          postgres    false    223            x           0    0    registro_admin_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.registro_admin_id_seq', 1, true);
          public          postgres    false    229            y           0    0    reportes_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.reportes_id_seq', 3, true);
          public          postgres    false    225            z           0    0    resenas_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.resenas_id_seq', 3, true);
          public          postgres    false    234            {           0    0    usuarios_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.usuarios_id_seq', 13, true);
          public          postgres    false    227            �           2606    16451 &   administrador administrador_correo_key 
   CONSTRAINT     c   ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_correo_key UNIQUE (correo);
 P   ALTER TABLE ONLY public.administrador DROP CONSTRAINT administrador_correo_key;
       public            postgres    false    215            �           2606    16453     administrador administrador_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (codigo_maestro);
 J   ALTER TABLE ONLY public.administrador DROP CONSTRAINT administrador_pkey;
       public            postgres    false    215            �           2606    16455    chat chat_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_pkey;
       public            postgres    false    216            �           2606    16457    libro libro_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.libro DROP CONSTRAINT libro_pkey;
       public            postgres    false    218            �           2606    16461    lista_espera lista_espera_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_pkey PRIMARY KEY (id_lista);
 H   ALTER TABLE ONLY public.lista_espera DROP CONSTRAINT lista_espera_pkey;
       public            postgres    false    220            �           2606    16562    mensajes mensajes_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.mensajes
    ADD CONSTRAINT mensajes_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.mensajes DROP CONSTRAINT mensajes_pkey;
       public            postgres    false    233            �           2606    16463    prestamo prestamo_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_pkey;
       public            postgres    false    222            �           2606    16543 "   registro_admin registro_admin_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.registro_admin
    ADD CONSTRAINT registro_admin_pkey PRIMARY KEY (id);
 L   ALTER TABLE ONLY public.registro_admin DROP CONSTRAINT registro_admin_pkey;
       public            postgres    false    230            �           2606    16465    reportes reportes_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_pkey;
       public            postgres    false    224            �           2606    16572    resenas resenas_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.resenas
    ADD CONSTRAINT resenas_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.resenas DROP CONSTRAINT resenas_pkey;
       public            postgres    false    235            �           2606    16533 4   solicitud_administrador solicitud_administrador_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.solicitud_administrador
    ADD CONSTRAINT solicitud_administrador_pkey PRIMARY KEY (codigo_maestro);
 ^   ALTER TABLE ONLY public.solicitud_administrador DROP CONSTRAINT solicitud_administrador_pkey;
       public            postgres    false    228            �           2606    16550 ,   solicitud_prestamos solicitud_prestamos_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.solicitud_prestamos
    ADD CONSTRAINT solicitud_prestamos_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.solicitud_prestamos DROP CONSTRAINT solicitud_prestamos_pkey;
       public            postgres    false    231            �           2606    16467 '   usuarios usuarios_codigo_estudiante_key 
   CONSTRAINT     o   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_codigo_estudiante_key UNIQUE (codigo_estudiante);
 Q   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_codigo_estudiante_key;
       public            postgres    false    226            �           2606    16469    usuarios usuarios_correo_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);
 F   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_correo_key;
       public            postgres    false    226            �           2606    16471    usuarios usuarios_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT usuarios_pkey;
       public            postgres    false    226            �           2606    16472     chat chat_usuario_emisor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_emisor_id_fkey FOREIGN KEY (usuario_emisor_id) REFERENCES public.usuarios(id);
 J   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_usuario_emisor_id_fkey;
       public          postgres    false    4779    226    216            �           2606    16477 "   chat chat_usuario_receptor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_receptor_id_fkey FOREIGN KEY (usuario_receptor_id) REFERENCES public.usuarios(id);
 L   ALTER TABLE ONLY public.chat DROP CONSTRAINT chat_usuario_receptor_id_fkey;
       public          postgres    false    226    216    4779            �           2606    16482    libro libro_poosedor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_poosedor_id_fkey FOREIGN KEY (poseedor_id) REFERENCES public.usuarios(id);
 F   ALTER TABLE ONLY public.libro DROP CONSTRAINT libro_poosedor_id_fkey;
       public          postgres    false    218    4779    226            �           2606    16492 '   lista_espera lista_espera_libro_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_libro_id_fkey FOREIGN KEY (id_libro) REFERENCES public.libro(id);
 Q   ALTER TABLE ONLY public.lista_espera DROP CONSTRAINT lista_espera_libro_id_fkey;
       public          postgres    false    220    4767    218            �           2606    16497 &   prestamo prestamo_libro_emisor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_emisor_id_fkey FOREIGN KEY (libro_emisor_id) REFERENCES public.libro(id);
 P   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_libro_emisor_id_fkey;
       public          postgres    false    4767    218    222            �           2606    16502 (   prestamo prestamo_libro_receptor_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_receptor_id_fkey FOREIGN KEY (libro_receptor_id) REFERENCES public.libro(id);
 R   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_libro_receptor_id_fkey;
       public          postgres    false    222    218    4767            �           2606    16507 -   prestamo prestamo_usuario_prestamista_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_prestamista_id_fkey FOREIGN KEY (usuario_prestamista_id) REFERENCES public.usuarios(id);
 W   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_usuario_prestamista_id_fkey;
       public          postgres    false    4779    226    222            �           2606    16512 -   prestamo prestamo_usuario_solicitante_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_solicitante_id_fkey FOREIGN KEY (usuario_solicitante_id) REFERENCES public.usuarios(id);
 W   ALTER TABLE ONLY public.prestamo DROP CONSTRAINT prestamo_usuario_solicitante_id_fkey;
       public          postgres    false    4779    226    222            �           2606    16517 +   reportes reportes_usuario_reportado_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportado_id_fkey FOREIGN KEY (usuario_reportado_id) REFERENCES public.usuarios(id);
 U   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_usuario_reportado_id_fkey;
       public          postgres    false    226    4779    224            �           2606    16522 ,   reportes reportes_usuario_reportante_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportante_id_fkey FOREIGN KEY (usuario_reportante_id) REFERENCES public.usuarios(id);
 V   ALTER TABLE ONLY public.reportes DROP CONSTRAINT reportes_usuario_reportante_id_fkey;
       public          postgres    false    226    224    4779            O   �   x�3220�4��0��J��,Rp�I�J�K)�W�,K-JTp,K��/������@�sJs���JS��r+8U�*UT�r���K�,�J���B}���BJK�K+�âL��}�K���
�S<�ͫ�MS9����b���� �-      P      x������ � �      R   
  x��XMs�8=ӿ5�=y5"%�co��ę�'�q2���*�$� �H9ʿ�qs�ڟ�?��AQ�|��ŖI4Я_�~�|�]��w�+�ĵi�b��/�e9)��b���55�u�����������;
���l�&�h2U���b�n����PK��u0�G�3�{H+�V:j��>�;M��*�k�Yј�����^X�n��d�WG���Td6]Y��r�H��(ũ�ǭ����'Ev���⸵�"��Ψ(^�l�G��H\�� �dy�/�r1]d��o�Ku9�c]�C�bW�;��ac�P��$��Bv������HppA�v#��BQ������Z���l��-5b�C�Y, �m+��]-/��F��^��(F�W��l���Ŋ�ĪsZ6��F���8����@2mɫ��Њ���C��)��Fow4Be���5�u�S�5E��#�!.x G_�'g�Ѥ�,�o�ڴ��PG&q�4�T�@�H��ˁ�(�0�yk�2-i��-��TH�Q��X�g��,+��nM�0M�O�r�(��N\K/^�5_�V�.���3���Ƌr\S���(����zJ��dV�A�rtW��`u"й�Cɐ3���[�����+CZjA�bm�Vj)�>p��?�p7���؋C������5"K��_K�kG"v�TC�I�k	0\Ȁ.�R�H���f���qv)ŕt^���k�p*�qŻ��`p��c����G�Mg\l:ͧ�E^�طP�W˙���U[� ��J�pˬ`��yC��Qe,�h#k�����v�	՗Mmd�����1�'�B��D�\��5	Gk���Ai�t_$H��[�(��"�O�M�ӧ!�d?*��xو7���L9[���1���\u].��>��� 9����>#}uKᔙHٮ��2Ȕ��K��^XK;$�h�Vb��
b�f���@"��q��<:�Yv��E��DF.���#tGG/I�k?�&y�,�秨��%�&�"��VC�JS���<��y:,�=��ȁ���p�X����xh*$�ƃWa����%�ͮ[�Z�x�z�M�� c|Hjq�[<�/�׬�	��QJ%^D���q�.'��)�c΢��d��V�C�ä���k�i��j�
�AZf�L2Mg��J����� �A) ;tG��U��W��������J�"��0.����q����֯H���:��-�����l#ϊy��gt7)������?kHH���^���a?f��=��z�0�PY_�ƥ?d�3xA,���s��@���t�_��Q�׏���@��W�o�i/�Ӂ����2V$���z
����4^�}YcRB|:m�"����I�!�ӆ��~�ĵ,G�Ⱥ�%�Ro�����%[�fw#�yxK$N�����gA�4	;_���zJ�N�e�x�
%�Z�|�""V�#&�/F���[����M�h�M�}R�����?
�Fuux<��Yh�ʆI�p���\v	Uf'	A�cA�^A(�}?�RM�:� ���z��O�;b�������l</��1l�mL5~H֕�33w)x������ ��+ u@ �aY{��ܱ�]:<!�zX($���p%6)�*�PP�z+J۶��㔟CF|��M�2�z��($�I�
�?���1�R�dp��}g�uH�J����.ڂ	k�E�&A��I�<b7�p�³���Yd�V��Y�=X�u�p;8����@���Iv����A��h����g�5A�eph�,/��\�_7����<���	���I�ށ_�@)߶�L��V�,��qB\u{���7��4�P�y!���Z�\q�g�ɬa�S��`��jp�4Á�9�p�\l���� � A�f���[J�@E<ඣ�P;X���2�^u���A�[qA~�<�8���ɓ{����=�4�<g��`�G�g�5��{��.����H� H�ٓ�& O�:���.��1��&X���8v �'w�쒨�1v�8��ս:�������l�x�	���*�e�����b$�kd�Sm^�)O�&�,h1+�}0������{e4���d�{T��cg�Ԡ�!�@�_S��]�R�+�=Y�e��s�[j�̑�댠b�i{'�C�ƹ�7���7w�v\@MC�0!5��z���8�8챲ݍ�}9{u���Ee�M_펕��LW�^\��l}v1z3���ޔN˼������7.y˥^HUT-
Q5Rḿ��4�
�Rz����:�[v���/5�Ǜ!\�a��+D�ӹ���^���-��:O�-�w�E���+^���hΆL+�B��܋��{݅����l>���'x��/P��jU���*�|��>J&%lX��q��,�,�I7�6�{W��\'��A�t��&vP���8�����J3��I�B36����M��He�t�48%���k܊�Ý�g�	��/OV
W�$�|��&Me����J��(�!��2��+����'S
=����4�3�kʠ�]��#��CO6]��-6dkp� �ÀF~�ԡ�A���_�-�r���+����NNN� �       T      x������ � �      a      x������ � �      V      x������ � �      ^   �   x�ʻ�0��<EV��#m�I415�>�
��Z���7����I����q���ɬ���[M㇮LKʟ2�o}����\ݘ�����Q�ǥB%B�� ���s�G��v�(�β�-V��|������� �,�����=ͦO���"'Kc���a� D�@\D�PHT�wd��},�7�      X      x������ � �      c   V   x�3�4��-�TH*M��/V��L*�/��4202�50�52��[XXry!��y�P�
�@��y%�E�ŉ@
U�	��=... W�	      \      x������ � �      _      x������ � �      Z   �  x���]o�@���Wx�[�e��X?�jc�41#,����_�G='=�n6����d�wfe���%�"W|(�Z���a���L-\_��+��Bڕ57f�����&�4���g[}�e�x���G���bR>K�=*�9U0��3�D���35�Em�H�r�)5��bb0δe"�"�Z���
ʖ��M5H��)@�7)��)���)��"����e�����Ls��!��9�;Ȕ�մ�L�%{�^4�v�w����	)� ��h��oi�\l׳^`��c���2���?�gD8��a'E�B:6u���Pgq��>�;+t��2mvBT�O���B���0�8�U�\p����>���t���r��B�&#����l�C��cS��2�>�y.F0�Lg�89��e��Z�gAj}�g �g�BG�8qЏ����<����ƴݼ���w�JN]=\�Hj}�c���:���ngd˾/�[�
%����4})�A���6�R�8:�}��C8��?�]��K�O��ndt@N����a��i�׉(EV-}���^�_X:%���B�馼�ϓ,P��[�g�ma�L{h�am	<w�zi(�q'UO	f��T������@0�Z���:7قj:j';�$)[&&&�y�_�F���<��     