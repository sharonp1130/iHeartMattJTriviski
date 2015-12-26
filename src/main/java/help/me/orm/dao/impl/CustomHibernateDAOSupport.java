package help.me.orm.dao.impl;

import java.lang.reflect.ParameterizedType;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate4.support.HibernateDaoSupport;

import help.me.orm.dao.IDao;

/**
 * All DAOs extend this class.  Need this because we are using annotations and 
 * have to be able to autowire...not sure why when creating this but it was in 
 * one of the mkyong tutorials.
 * 
 * The stuff with the persistent class was taken from a jboss tutorial about generics and hibernate.  
 * @author triviski
 *
 */
public abstract class CustomHibernateDAOSupport<T> extends HibernateDaoSupport implements IDao<T> {
	private Class<T> persistentClass;
	
	@SuppressWarnings("unchecked")
	public CustomHibernateDAOSupport() {
		super();
		
        this.persistentClass = (Class<T>) ((ParameterizedType) getClass()  
                .getGenericSuperclass()).getActualTypeArguments()[0];  
	}

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

	@Override
	public T findById(Integer id) {
		return(T) getHibernateTemplate().get(persistentClass, id);
	}
	
	/**
	 * @return the current hibernate session
	 */
	public Session getCurrentSession() {
		return getHibernateTemplate().getSessionFactory().getCurrentSession();
	}
}
