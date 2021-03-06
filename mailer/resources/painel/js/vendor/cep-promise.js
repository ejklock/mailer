!(function(e, r) {
  "object" == typeof exports && "undefined" != typeof module
    ? (module.exports = r(require("isomorphic-unfetch")))
    : "function" == typeof define && define.amd
    ? define(["isomorphic-unfetch"], r)
    : (e.cep = r(e.fetch));
})(this, function(e) {
  "use strict";
  function r(r) {
    var c = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "",
      i = c + "http://www.cepaberto.com/api/v2/ceps.json?cep=" + r,
      s = {
        method: "GET",
        mode: "cors",
        headers: {
          "content-type": "application/json;charset=utf-8",
          Authorization: "Token token=" + N
        }
      };
    return e(i, s)
      .then(t)
      .then(o)
      .then(n)
      .catch(a);
  }
  function t(e) {
    if (e.ok) return e.json();
    throw Error("Erro ao se conectar com o serviço Cep Aberto.");
  }
  function o(e) {
    if (!Object.keys(e).length)
      throw new Error("CEP não encontrado na base do Cep Aberto.");
    return e;
  }
  function n(e) {
    return {
      cep: e.cep,
      state: e.estado,
      city: e.cidade,
      neighborhood: e.bairro,
      street: e.logradouro
    };
  }
  function a(e) {
    var r = new z({ message: e.message, service: "cepaberto" });
    throw ("FetchError" === e.name &&
      (r.message = "Erro ao se conectar com o serviço Cep Aberto."),
    r);
  }
  function c(r) {
    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "",
      o =
        t +
        "https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente",
      n = {
        method: "POST",
        body:
          '<?xml version="1.0"?>\n<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:cli="http://cliente.bean.master.sigep.bsb.correios.com.br/">\n  <soapenv:Header />\n  <soapenv:Body>\n    <cli:consultaCEP>\n      <cep>' +
          r +
          "</cep>\n    </cli:consultaCEP>\n  </soapenv:Body>\n</soapenv:Envelope>",
        headers: {
          "Content-Type": "text/xml;charset=UTF-8",
          "cache-control": "no-cache"
        }
      };
    return e(o, n)
      .then(i)
      .catch(h);
  }
  function i(e) {
    return e.ok
      ? e
          .text()
          .then(s)
          .then(f)
      : e
          .text()
          .then(u)
          .then(p);
  }
  function s(e) {
    try {
      var r =
          e.replace(/\r?\n|\r/g, "").match(/<return>(.*)<\/return>/)[0] || "",
        t = r.replace("<return>", "").replace("</return>", ""),
        o = t.split(/</).reduce(function(e, r) {
          var t = r.split(">");
          return t.length > 1 && t[1].length && (e[t[0]] = t[1]), e;
        }, {});
      return o;
    } catch (e) {
      throw new Error("Não foi possível interpretar o XML de resposta.");
    }
  }
  function u(e) {
    try {
      var r = e.match(/<faultstring>(.*)<\/faultstring>/)[0] || "",
        t = r.replace("<faultstring>", "").replace("</faultstring>", "");
      return t;
    } catch (e) {
      throw new Error("Não foi possível interpretar o XML de resposta.");
    }
  }
  function p(e) {
    throw new Error(e);
  }
  function f(e) {
    return {
      cep: e.cep,
      state: e.uf,
      city: e.cidade,
      neighborhood: e.bairro,
      street: e.end
    };
  }
  function h(e) {
    var r = new z({ message: e.message, service: "correios" });
    throw ("FetchError" === e.name &&
      (r.message = "Erro ao se conectar com o serviço dos Correios."),
    r);
  }
  function l(r) {
    var t = "https://viacep.com.br/ws/" + r + "/json/",
      o = {
        method: "GET",
        mode: "cors",
        headers: { "content-type": "application/json;charset=utf-8" }
      };
    return e(t, o)
      .then(m)
      .then(d)
      .then(v)
      .catch(y);
  }
  function m(e) {
    if (e.ok) return e.json();
    throw Error("Erro ao se conectar com o serviço ViaCEP.");
  }
  function d(e) {
    if (e.erro === !0) throw new Error("CEP não encontrado na base do ViaCEP.");
    return e;
  }
  function v(e) {
    return {
      cep: e.cep.replace("-", ""),
      state: e.uf,
      city: e.localidade,
      neighborhood: e.bairro,
      street: e.logradouro
    };
  }
  function y(e) {
    var r = new z({ message: e.message, service: "viacep" });
    throw ("FetchError" === e.name &&
      (r.message = "Erro ao se conectar com o serviço ViaCEP."),
    r);
  }
  function g() {
    return "undefined" != typeof window;
  }
  function b(e) {
    return function(r) {
      return e(r, M);
    };
  }
  function w(e) {
    return Promise.resolve(e)
      .then(E)
      .then(P)
      .then(_)
      .then(C)
      .then(j)
      .catch(x)
      .catch(O);
  }
  function E(e) {
    var r = "undefined" == typeof e ? "undefined" : S(e);
    if ("number" === r || "string" === r) return e;
    throw new V({
      message: "Erro ao inicializar a instância do CepPromise.",
      type: "validation_error",
      errors: [
        {
          message:
            "Você deve chamar o construtor utilizando uma String ou um Number.",
          service: "cep_validation"
        }
      ]
    });
  }
  function P(e) {
    return e.toString().replace(/\D+/g, "");
  }
  function C(e) {
    return "0".repeat(X - e.length) + e;
  }
  function _(e) {
    if (e.length <= X) return e;
    throw new V({
      message: "CEP deve conter exatamente " + X + " caracteres.",
      type: "validation_error",
      errors: [
        {
          message: "CEP informado possui mais do que " + X + " caracteres.",
          service: "cep_validation"
        }
      ]
    });
  }
  function j(e) {
    return Promise.any([q(e), B(e), G(e)]);
  }
  function x(e) {
    if (void 0 !== e.length)
      throw new V({
        message: "Todos os serviços de CEP retornaram erro.",
        type: "service_error",
        errors: e
      });
    throw e;
  }
  function O(e) {
    var r = e.message,
      t = e.type,
      o = e.errors;
    throw new V({ message: r, type: t, errors: o });
  }
  e = e && e.hasOwnProperty("default") ? e.default : e;
  var S =
      "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
        ? function(e) {
            return typeof e;
          }
        : function(e) {
            return e &&
              "function" == typeof Symbol &&
              e.constructor === Symbol &&
              e !== Symbol.prototype
              ? "symbol"
              : typeof e;
          },
    A = function(e, r) {
      if (!(e instanceof r))
        throw new TypeError("Cannot call a class as a function");
    },
    T = function(e, r) {
      if ("function" != typeof r && null !== r)
        throw new TypeError(
          "Super expression must either be null or a function, not " + typeof r
        );
      (e.prototype = Object.create(r && r.prototype, {
        constructor: {
          value: e,
          enumerable: !1,
          writable: !0,
          configurable: !0
        }
      })),
        r &&
          (Object.setPrototypeOf
            ? Object.setPrototypeOf(e, r)
            : (e.__proto__ = r));
    },
    k = function(e, r) {
      if (!e)
        throw new ReferenceError(
          "this hasn't been initialised - super() hasn't been called"
        );
      return !r || ("object" != typeof r && "function" != typeof r) ? e : r;
    },
    F = function(e) {
      if (Array.isArray(e)) {
        for (var r = 0, t = Array(e.length); r < e.length; r++) t[r] = e[r];
        return t;
      }
      return Array.from(e);
    },
    V = (function(e) {
      function r() {
        var e =
            arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
          t = e.message,
          o = e.type,
          n = e.errors;
        A(this, r);
        var a = k(this, (r.__proto__ || Object.getPrototypeOf(r)).call(this));
        return (
          (a.name = "CepPromiseError"),
          (a.message = t),
          (a.type = o),
          (a.errors = n),
          a
        );
      }
      return T(r, e), r;
    })(Error),
    z = (function(e) {
      function r() {
        var e =
            arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
          t = e.message,
          o = e.service;
        A(this, r);
        var n = k(this, (r.__proto__ || Object.getPrototypeOf(r)).call(this));
        return (n.name = "ServiceError"), (n.message = t), (n.service = o), n;
      }
      return T(r, e), r;
    })(Error),
    M = "https://proxier.now.sh/",
    N = "37d718d2984e6452584a76d3d59d3a26",
    q = g() ? b(r) : r,
    B = g() ? b(c) : c,
    G = l,
    L = function(e) {
      return new Promise(function(r, t) {
        return Promise.resolve(e).then(t, r);
      });
    };
  Promise.any = function(e) {
    return L(Promise.all([].concat(F(e)).map(L)));
  };
  var X = 8;
  return w;
});
