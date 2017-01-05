cofetaria-ioana
===============

A Symfony project created on December 1, 2016, 4:12 pm.


pentru CRUDController
*******list******
-        $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($formView, $this->admin->getFilterTheme());
+        if ($this->has('twig.form.renderer')) {
+            $this->get('twig.form.renderer')->setTheme($formView, $this->admin->getFilterTheme());
+        } else {
+            // BC for Symfony < 3.2
+            $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($formView, $this->admin->getFilterTheme());
+        }

*******edit******
-        $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($view, $this->admin->getFormTheme());
+        if ($this->has('twig.form.renderer')) {
+            $this->get('twig.form.renderer')->setTheme($view, $this->admin->getFilterTheme());
+        } else {
+            // BC for Symfony < 3.2
+            $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($view, $this->admin->getFilterTheme());
+        }

*******crete******
-        $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($view, $this->admin->getFormTheme());
+        if ($this->has('twig.form.renderer')) {
+            $this->get('twig.form.renderer')->setTheme($view, $this->admin->getFilterTheme());
+        } else {
+            // BC for Symfony < 3.2
+            $this->get('twig')->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($view, $this->admin->getFilterTheme());
+        }

array(0 => 'SonataDoctrineORMAdminBundle:Form:form_admin_fields.html.twig')