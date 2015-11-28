package help.me.orm.dao;

import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate3.support.HibernateDaoSupport;

/**
 * All DAOs extend this class.  Need this because we are using annotations and 
 * have to be able to autowire...not sure why when creating this but it was in 
 * one of the mkyong tutorials.
 * 
 * @author triviski
 *
 */
public abstract class CustomHibernateDAOSupport<T> extends HibernateDaoSupport implements IDao<T> {
	
	@Autowired
    public void autoWire(SessionFactory sessionFactory) {
        setSessionFactory(sessionFactory);
    }
	
    @Override
	public void save(T entity) {
    		getHibernateTemplate().save(entity);
	}

	@Override
	public void update(T entity) {
		getHibernateTemplate().update(entity);
	}

	@Override
	public void delete(T entity) {
		getHibernateTemplate().delete(entity);
	}

	@Override
	public void saveOrUpdate(T entity) {
		getHibernateTemplate().saveOrUpdate(entity);
	}
}
