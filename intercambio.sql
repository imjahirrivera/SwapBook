--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3
-- Dumped by pg_dump version 16.3

-- Started on 2024-05-17 17:59:30

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 16399)
-- Name: administrador; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);


ALTER TABLE public.administrador OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16404)
-- Name: chat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chat (
    id integer NOT NULL,
    usuario_emisor_id integer,
    usuario_emisor character varying(100),
    usuario_receptor_id integer,
    usuario_receptor character varying(100),
    mensaje text
);


ALTER TABLE public.chat OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16409)
-- Name: chat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chat_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.chat_id_seq OWNER TO postgres;

--
-- TOC entry 4932 (class 0 OID 0)
-- Dependencies: 217
-- Name: chat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chat_id_seq OWNED BY public.chat.id;


--
-- TOC entry 218 (class 1259 OID 16410)
-- Name: libro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.libro (
    id integer NOT NULL,
    titulo character varying(50),
    autor character varying(100),
    isbn character varying(12),
    estatus boolean DEFAULT true,
    estado_fisico character varying(10),
    imagen_portada character varying(255),
    sinopsis text,
    editorial character varying(100),
    num_paginas integer,
    poseedor_id integer
);


ALTER TABLE public.libro OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16416)
-- Name: libro_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.libro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.libro_id_seq OWNER TO postgres;

--
-- TOC entry 4933 (class 0 OID 0)
-- Dependencies: 219
-- Name: libro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.libro_id_seq OWNED BY public.libro.id;


--
-- TOC entry 220 (class 1259 OID 16417)
-- Name: lista_espera; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lista_espera (
    lista_id integer NOT NULL,
    libro_id integer,
    cantidad_usuarios integer,
    codigo_estudiante character varying(20)
);


ALTER TABLE public.lista_espera OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16420)
-- Name: lista_espera_lista_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lista_espera_lista_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.lista_espera_lista_id_seq OWNER TO postgres;

--
-- TOC entry 4934 (class 0 OID 0)
-- Dependencies: 221
-- Name: lista_espera_lista_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lista_espera_lista_id_seq OWNED BY public.lista_espera.lista_id;


--
-- TOC entry 222 (class 1259 OID 16421)
-- Name: prestamo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prestamo (
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


ALTER TABLE public.prestamo OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16426)
-- Name: prestamo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.prestamo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.prestamo_id_seq OWNER TO postgres;

--
-- TOC entry 4935 (class 0 OID 0)
-- Dependencies: 223
-- Name: prestamo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.prestamo_id_seq OWNED BY public.prestamo.id;


--
-- TOC entry 224 (class 1259 OID 16427)
-- Name: reportes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reportes (
    id integer NOT NULL,
    usuario_reportante_id integer,
    usuario_reportante character varying(100),
    usuario_reportado_id integer,
    usuario_reportado character varying(100),
    descripcion text,
    fecha timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    estado character varying(100)
);


ALTER TABLE public.reportes OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16433)
-- Name: reportes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reportes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reportes_id_seq OWNER TO postgres;

--
-- TOC entry 4936 (class 0 OID 0)
-- Dependencies: 225
-- Name: reportes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reportes_id_seq OWNED BY public.reportes.id;


--
-- TOC entry 228 (class 1259 OID 16527)
-- Name: solicitud_administrador; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud_administrador (
    codigo_maestro integer NOT NULL,
    nombre_completo character varying(100),
    correo character varying(100),
    "contraseña" character varying(255),
    foto_perfil character varying(255)
);


ALTER TABLE public.solicitud_administrador OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 16434)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
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
    estado character varying(50) DEFAULT 'usuario registrado'::character varying
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 16443)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO postgres;

--
-- TOC entry 4937 (class 0 OID 0)
-- Dependencies: 227
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- TOC entry 4721 (class 2604 OID 16444)
-- Name: chat id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat ALTER COLUMN id SET DEFAULT nextval('public.chat_id_seq'::regclass);


--
-- TOC entry 4722 (class 2604 OID 16445)
-- Name: libro id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.libro ALTER COLUMN id SET DEFAULT nextval('public.libro_id_seq'::regclass);


--
-- TOC entry 4724 (class 2604 OID 16446)
-- Name: lista_espera lista_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_espera ALTER COLUMN lista_id SET DEFAULT nextval('public.lista_espera_lista_id_seq'::regclass);


--
-- TOC entry 4725 (class 2604 OID 16447)
-- Name: prestamo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo ALTER COLUMN id SET DEFAULT nextval('public.prestamo_id_seq'::regclass);


--
-- TOC entry 4728 (class 2604 OID 16448)
-- Name: reportes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reportes ALTER COLUMN id SET DEFAULT nextval('public.reportes_id_seq'::regclass);


--
-- TOC entry 4730 (class 2604 OID 16449)
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- TOC entry 4913 (class 0 OID 16399)
-- Dependencies: 215
-- Data for Name: administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
\.


--
-- TOC entry 4914 (class 0 OID 16404)
-- Dependencies: 216
-- Data for Name: chat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chat (id, usuario_emisor_id, usuario_emisor, usuario_receptor_id, usuario_receptor, mensaje) FROM stdin;
\.


--
-- TOC entry 4916 (class 0 OID 16410)
-- Dependencies: 218
-- Data for Name: libro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.libro (id, titulo, autor, isbn, estatus, estado_fisico, imagen_portada, sinopsis, editorial, num_paginas, poseedor_id) FROM stdin;
\.


--
-- TOC entry 4918 (class 0 OID 16417)
-- Dependencies: 220
-- Data for Name: lista_espera; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lista_espera (lista_id, libro_id, cantidad_usuarios, codigo_estudiante) FROM stdin;
\.


--
-- TOC entry 4920 (class 0 OID 16421)
-- Dependencies: 222
-- Data for Name: prestamo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.prestamo (id, usuario_solicitante_id, usuario_solicitante, usuario_prestamista_id, usuario_prestamista, fecha_prestamo, fecha_devolucion, libro_emisor_id, libro_emisor, libro_receptor_id, libro_receptor, fecha_inicio_prestamo, fecha_fin_prestamo) FROM stdin;
\.


--
-- TOC entry 4922 (class 0 OID 16427)
-- Dependencies: 224
-- Data for Name: reportes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reportes (id, usuario_reportante_id, usuario_reportante, usuario_reportado_id, usuario_reportado, descripcion, fecha, estado) FROM stdin;
\.


--
-- TOC entry 4926 (class 0 OID 16527)
-- Dependencies: 228
-- Data for Name: solicitud_administrador; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud_administrador (codigo_maestro, nombre_completo, correo, "contraseña", foto_perfil) FROM stdin;
\.


--
-- TOC entry 4924 (class 0 OID 16434)
-- Dependencies: 226
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, nombre_completo, correo, "contraseña", telefono, codigo_estudiante, foto_perfil, foto_credencial, strikes, baneado, fecha_baneo, baneado_permanente, estado) FROM stdin;
2	Jahir Alejandro Rivera Avalos	jahir.rivera9088@alumnos.udg.mx	$2y$10$aDLW1qDQw6YSK1ckyLQl6u.nRM6.jXDwVY/eL6boo9ebLipDPltte	7531672754	220790881	./user/img/6647aa2f4dc40_Trunks.JPG	./user/img/6647aa2f4de21_opc1.jpg	0	f	\N	f	usuario registrado
3	Lia Perez Gomez	lia.perez2432@alumnos.udg.mx	$2y$10$yqkKeG7YKtkaY5S0fvHDDONAxiiLxEqmGsrphPHcX.1ZhwzVpEgjW	1234567890	220790883	./user/img/6647c68556e3b_Trunks.JPG	./user/img/6647c685570ac_opc1.jpg	0	f	\N	f	usuario registrado
\.


--
-- TOC entry 4938 (class 0 OID 0)
-- Dependencies: 217
-- Name: chat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chat_id_seq', 1, false);


--
-- TOC entry 4939 (class 0 OID 0)
-- Dependencies: 219
-- Name: libro_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.libro_id_seq', 1, true);


--
-- TOC entry 4940 (class 0 OID 0)
-- Dependencies: 221
-- Name: lista_espera_lista_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lista_espera_lista_id_seq', 1, false);


--
-- TOC entry 4941 (class 0 OID 0)
-- Dependencies: 223
-- Name: prestamo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prestamo_id_seq', 1, false);


--
-- TOC entry 4942 (class 0 OID 0)
-- Dependencies: 225
-- Name: reportes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reportes_id_seq', 1, false);


--
-- TOC entry 4943 (class 0 OID 0)
-- Dependencies: 227
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 3, true);


--
-- TOC entry 4736 (class 2606 OID 16451)
-- Name: administrador administrador_correo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_correo_key UNIQUE (correo);


--
-- TOC entry 4738 (class 2606 OID 16453)
-- Name: administrador administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.administrador
    ADD CONSTRAINT administrador_pkey PRIMARY KEY (codigo_maestro);


--
-- TOC entry 4740 (class 2606 OID 16455)
-- Name: chat chat_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_pkey PRIMARY KEY (id);


--
-- TOC entry 4742 (class 2606 OID 16457)
-- Name: libro libro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_pkey PRIMARY KEY (id);


--
-- TOC entry 4744 (class 2606 OID 16459)
-- Name: lista_espera lista_espera_codigo_estudiante_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_codigo_estudiante_key UNIQUE (codigo_estudiante);


--
-- TOC entry 4746 (class 2606 OID 16461)
-- Name: lista_espera lista_espera_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_pkey PRIMARY KEY (lista_id);


--
-- TOC entry 4748 (class 2606 OID 16463)
-- Name: prestamo prestamo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_pkey PRIMARY KEY (id);


--
-- TOC entry 4750 (class 2606 OID 16465)
-- Name: reportes reportes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_pkey PRIMARY KEY (id);


--
-- TOC entry 4758 (class 2606 OID 16533)
-- Name: solicitud_administrador solicitud_administrador_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud_administrador
    ADD CONSTRAINT solicitud_administrador_pkey PRIMARY KEY (codigo_maestro);


--
-- TOC entry 4752 (class 2606 OID 16467)
-- Name: usuarios usuarios_codigo_estudiante_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_codigo_estudiante_key UNIQUE (codigo_estudiante);


--
-- TOC entry 4754 (class 2606 OID 16469)
-- Name: usuarios usuarios_correo_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_correo_key UNIQUE (correo);


--
-- TOC entry 4756 (class 2606 OID 16471)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- TOC entry 4759 (class 2606 OID 16472)
-- Name: chat chat_usuario_emisor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_emisor_id_fkey FOREIGN KEY (usuario_emisor_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4760 (class 2606 OID 16477)
-- Name: chat chat_usuario_receptor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat
    ADD CONSTRAINT chat_usuario_receptor_id_fkey FOREIGN KEY (usuario_receptor_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4761 (class 2606 OID 16482)
-- Name: libro libro_poosedor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.libro
    ADD CONSTRAINT libro_poosedor_id_fkey FOREIGN KEY (poseedor_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4762 (class 2606 OID 16487)
-- Name: lista_espera lista_espera_codigo_estudiante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_codigo_estudiante_fkey FOREIGN KEY (codigo_estudiante) REFERENCES public.usuarios(codigo_estudiante);


--
-- TOC entry 4763 (class 2606 OID 16492)
-- Name: lista_espera lista_espera_libro_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lista_espera
    ADD CONSTRAINT lista_espera_libro_id_fkey FOREIGN KEY (libro_id) REFERENCES public.libro(id);


--
-- TOC entry 4764 (class 2606 OID 16497)
-- Name: prestamo prestamo_libro_emisor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_emisor_id_fkey FOREIGN KEY (libro_emisor_id) REFERENCES public.libro(id);


--
-- TOC entry 4765 (class 2606 OID 16502)
-- Name: prestamo prestamo_libro_receptor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_libro_receptor_id_fkey FOREIGN KEY (libro_receptor_id) REFERENCES public.libro(id);


--
-- TOC entry 4766 (class 2606 OID 16507)
-- Name: prestamo prestamo_usuario_prestamista_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_prestamista_id_fkey FOREIGN KEY (usuario_prestamista_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4767 (class 2606 OID 16512)
-- Name: prestamo prestamo_usuario_solicitante_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prestamo
    ADD CONSTRAINT prestamo_usuario_solicitante_id_fkey FOREIGN KEY (usuario_solicitante_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4768 (class 2606 OID 16517)
-- Name: reportes reportes_usuario_reportado_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportado_id_fkey FOREIGN KEY (usuario_reportado_id) REFERENCES public.usuarios(id);


--
-- TOC entry 4769 (class 2606 OID 16522)
-- Name: reportes reportes_usuario_reportante_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reportes
    ADD CONSTRAINT reportes_usuario_reportante_id_fkey FOREIGN KEY (usuario_reportante_id) REFERENCES public.usuarios(id);


-- Completed on 2024-05-17 17:59:30

--
-- PostgreSQL database dump complete
--

