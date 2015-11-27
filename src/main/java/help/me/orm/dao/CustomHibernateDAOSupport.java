package help.me.orm.dao;

import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate3.support.HibernateDaoSupport;

/**
 * Allows for annotations blah.
 * 
 * @author triviski
 *
 */
public abstract class CustomHibernateDAOSupport extends HibernateDaoSupport {
	
    @Autowired
    public void autoWire(SessionFactory sessionFactory)
    {
        setSessionFactory(sessionFactory);
    }

}
